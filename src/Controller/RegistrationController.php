<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\Form\FormError;
use App\Security\AppAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Validator\Constraints\EmailDuplicate;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{

    const USER_ALREADY_EXISTS = 'User with such email already exists';

    private $validator;


    public function __construct( ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setEmail($form->get('email')->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/validate", name="app_validate")
     */
    public function validate(Request $request): Response
    {
        $msg = '';

        $violations = $this->validator->validate($request->get('email'), [
            new NotBlank([
                'message' => 'Please enter a email',
            ]),
            new Email(),
            new EmailDuplicate(),
        ]);
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $msg = $violation->getMessage();
            }
        }

        $response = new Response();
        $response->setContent(json_encode([
            'msg' => $msg,
        ]));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}

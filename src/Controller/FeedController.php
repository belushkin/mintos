<?php

namespace App\Controller;

use App\Util\FrequencyCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\FeedClient;
use App\Util\CommonWords;

class FeedController extends AbstractController
{
    /**
     * @Route("/", name="feed")
     * @param FeedClient $feedClient
     * @param CommonWords $commonWords
     * @param FrequencyCalculator $frequencyCalculator
     *
     * @return Response
     */
    public function index(FeedClient $feedClient, CommonWords $commonWords, FrequencyCalculator $frequencyCalculator): Response
    {
        $feedClient->setUrl('https://www.theregister.co.uk/software/headlines.atom');
        $words = $feedClient->getWordsAsString(
            $feedClient->read()
        );

        $top10Words = $frequencyCalculator->get10FrequentWords(
            $commonWords->exclude50CommonWords(strtolower($words))
        );

        return $this->render('feed/index.html.twig', [
            'controller_name'   => 'FeedController',
            'top10words'        => $top10Words
        ]);
    }

}

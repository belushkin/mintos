<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    /**
     * @Route("/", name="feed")
     */
    public function index()
    {
        return $this->render('feed/index.html.twig', [
            'controller_name' => 'FeedController',
        ]);
    }
}

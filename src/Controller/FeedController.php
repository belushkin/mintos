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
        $top10Words = [];
        $feedItems  = [];

         if ($this->getUser()) {
             $feedClient->setUrl('https://www.theregister.co.uk/software/headlines.atom');
             $feedItems  = $feedClient->read();
             $words      = $feedClient->getWordsAsString($feedItems);

             $top10Words = $frequencyCalculator->get10FrequentWords(
                 $commonWords->exclude50CommonWords(strtolower($words))
             );
         }

        return $this->render('feed/index.html.twig', [
            'controller_name'   => 'FeedController',
            'top10words'        => $top10Words,
            'items'             => $feedItems
        ]);
    }

}

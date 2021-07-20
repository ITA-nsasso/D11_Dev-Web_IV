<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\HttpClient\HttpClientInterface;

use App\Entity\Beer;

class BarController extends AbstractController
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        // dd("hello"); // stop les scripts et affiche un debug
        // dump("hello"); ne stope pas les scripts

        $beers = $this->getDoctrine()->getRepository(Beer::class);
        // dd($beers->latestBeers());

        return $this->render('bar/index.html.twig', [
            
            'controller_name' => 'BarController',
            'beers' => $beers->latestBeers(),
            
            ]
        );
    }
    
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('bar/contact.html.twig', [
            'title' => 'Contact page',
        ]);
    }
    
    #[Route('/mention', name: 'mention')]
    public function mention(): Response
    {
        return $this->render('mention/index.html.twig', [
            'title_mention' => 'Mentions légales',
        ]);
    }
    
    #[Route('/beers', name: 'beers')]
    public function beers(): Response
    {

        $beers = $this->getDoctrine()->getRepository(Beer::class);

        return $this->render('beers/index.html.twig', [
            'beers' => $beers->findAll(),
        ]);
    }
    
    #[Route('/beer/{id}', name: 'show_beer')]
    public function showBeer(int $id)
    {
        $beer = $this->getDoctrine()->getRepository(Beer::class);
        $beer = $beer->singleBeer($id);
        $beer = $beer[0];

        return $this->render('beer/index.html.twig', [
            
            'controller_name' => 'BarController',
            'beer' => $beer,
            
            ]
        );
    }

    private function beers_api(): Array
    {
        $response = $this->client->request(
            'GET',
            'https://raw.githubusercontent.com/Antoine07/hetic_symfony/main/Introduction/Data/beers.json'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}

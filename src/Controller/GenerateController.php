<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Beer;

class GenerateController extends AbstractController
{
    #[Route('/newbeer', name: 'create_beer')]
    public function createBeer(){
        $entityManager = $this->getDoctrine()->getManager();

        $beer = new Beer();
        $beer->setname('Super Beer');
        $beer->setPublishedAt(new \DateTime());
        $beer->setDescription('Ergonomic and stylish!');
        $beer->setRating(rand(0, 10));
        $beer->setStatus(rand(0, 1) ? "available" : "unavailable");

        $degrees = [0, 5, 4.5, 8, 9.5];
        $rand_key = array_rand($degrees, 1);
        $beer->setDegree($degrees[$rand_key]);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        // << git add >> 
        $entityManager->persist($beer);

        // actually executes the queries (i.e. the INSERT query)
        // << git commit >>
        $entityManager->flush();

        return new Response('Saved new beer with id '.$beer->getId());
    }
}

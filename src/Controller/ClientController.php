<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Client;

class ClientController extends AbstractController
{
    #[Route('/clients', name: 'clients')]
    public function clients(): Response
    {

        $clients = $this->getDoctrine()->getRepository(Client::class);

        return $this->render('clients/index.html.twig', [
            'clients' => $clients->findAll(),
        ]);
    }
}

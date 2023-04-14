<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil_index')]
    public function index(Security $security): Response
    {
        // Récupérer le nom et le rôle de l'utilisateur connecté (ou null s'il n'est pas connecté)
        $user = $security->getUser();

        // Si l'utilisateur est connecté, afficher un message de bienvenue avec son rôle
        if ($user) {
            $message = sprintf('Bienvenue %s (%s) sur notre site web!', $user->getUsername(), implode(', ', $user->getRoles()));
        } else {
            $message = 'Bienvenue sur notre site web!';
        }

        // Afficher la page d'accueil avec le message de bienvenue
        return $this->render('home/index.html.twig', ['message' => $message]);
    }







}


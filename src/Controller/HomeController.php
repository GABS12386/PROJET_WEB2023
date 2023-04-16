<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\SecurityController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class HomeController extends AbstractController
{
    /* #[Route('/', name: 'accueil_index')]
     public function index(SecurityController $security): Response
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
         return $this->render('Base/base.html.twig', ['message' => $message]);
     }*/

    #[Route('/', name: 'accueil_index')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérer les erreurs de connexion s'il y en a
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupérer le nom d'utilisateur entré précédemment
        $lastUsername = $authenticationUtils->getLastUsername();

        // Si l'utilisateur est connecté, rediriger vers la page de bienvenue
        if ($this->getUser()) {
            return $this->redirectToRoute('bienvenue');
        }

        // Afficher la page d'accueil avec le formulaire d'authentification
        return $this->render('home/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/bienvenue', name: 'bienvenue')]
    public function bienvenue(): Response
    {
        // Récupérer le nom et le rôle de l'utilisateur connecté
        $user = $this->getUser();

        // Afficher un message de bienvenue avec le rôle de l'utilisateur
        $message = sprintf('Bienvenue %s (%s) sur notre site web!', $user->getUsername(), implode(', ', $user->getRoles()));

        // Afficher la page de bienvenue avec le message de bienvenue
        return $this->render('bienvenue/index.html.twig', ['message' => $message]);
    }

}


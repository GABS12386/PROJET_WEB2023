<?php

namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DoctrineProduitController extends AbstractController
{
    #[Route('/', name: 'ajout_produit')]
    public function ajout_produit_controller(EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $produit
            ->setLibelle('Chaussure')
            ->setPrix(90.99)
            ->setQuantite(2)
        dump($produit);

        $em->persist($produit)
        $em->flush();
        dump($produit);

        return $this->redirectToRoute();
    }
}

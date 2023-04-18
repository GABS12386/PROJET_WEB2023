<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Routing\Annotation\Route;

class TestSecurityController extends AbstractController
{
    #[Route('/test/security', name: 'app_test_security')]
    public function index(EntityManagerInterface $em , UserPasswordHasherInterface $passwordHasher): Response
    {
        $user1 = new User();
        $user1 ->setLogin("sadmin")
                ->setNom("Sadmin")
                ->setBirthday( new \DateTimeImmutable("02/04/1950"))
                ->setRoles(["ROLE_SUPER_ADMIN"])
                ->setPrenom("Sadmin");
            $hashedPassword = $passwordHasher->hashPassword($user1, 'nimdas');
            $user1->setPassword($hashedPassword);



        $user2 = new User();
        $user2 ->setNom("sadmin")
            ->setPrenom("gilles");
        $hashedPassword = $passwordHasher->hashPassword($user1, 'nimdas');
        $user1->setPassword($hashedPassword);

        $em->persist($user1);

        $user1 = new User();
        $user1 ->setNom("sadmin")
            ->setPrenom("gilles");
        $hashedPassword = $passwordHasher->hashPassword($user1, 'nimdas');
        $user1->setPassword($hashedPassword);

        $em->persist($user1);

        $user1 = new User();
        $user1 ->setNom("sadmin")
            ->setPrenom("gilles");
        $hashedPassword = $passwordHasher->hashPassword($user1, 'nimdas');
        $user1->setPassword($hashedPassword);*/

        $em->persist($user1);
        $em->flush();


       return $this->redirectToRoute("accueil_index");
    }
}

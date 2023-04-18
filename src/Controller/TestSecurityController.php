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
                ->setNom("Jean")
                ->setBirthday( new \DateTimeImmutable("02/04/1950"))
                ->setRoles(["ROLE_SUPER_ADMIN"])
                ->setPrenom("Albert");
            $hashedPassword = $passwordHasher->hashPassword($user1, 'nimdas');
            $user1->setPassword($hashedPassword);

        $em->persist($user1);


        $user2 = new User();
        $user2 ->setLogin("gilles")
                ->setNom("Subrenat")
                ->setBirthday(new \DateTimeImmutable("05/06/1958"))
                ->setRoles(["ROLE_ADMIN"])
                ->setPrenom("Gilles");
            $hashedPassword2 = $passwordHasher ->hashPassword($user2,'sellig');
            $user2->setPassword($hashedPassword2);

        $em->persist($user2);

        $user3 = new User();
        $user3 ->setLogin("rita")
                ->setNom("Zrour")
                ->setBirthday(new \DateTimeImmutable("14/09/1965"))
                ->setRole(["ROLE_USER"])
                ->setPrenom("Rita");
            $hashedPassword3 = $passwordHasher ->hashPassword($user3,'atir');
            $user3->setPassword($hashedPassword3);

        $em->persist($user3);

        $user4 = new User();
        $user4 ->setLogin("simon")
                ->setNom("Rame")
                ->setBirthday(new \DateTimeImmutable("23/12/1982"))
                ->setRoles(["ROLE_USER"])
                ->setPrenom("Simon");
            $hashedPassword4 = $passwordHasher ->hashPassword($user4,'nomis');
            $user4->setPassword($hashedPassword4);

        $em->persist($user4);

        $em->flush();


       return $this->redirectToRoute("accueil_index");
    }
}

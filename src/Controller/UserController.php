<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}/show", name="userview")
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(int $id, EntityManagerInterface $entityManager)
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (empty($user)) {
            throw $this->createNotFoundException("This user does not exist.");
        }

        return $this->render("user/user_detail.html.twig", ["user" => $user]);
    }
}
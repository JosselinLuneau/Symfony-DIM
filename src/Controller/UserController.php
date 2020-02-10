<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}/show", name="userview")
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(User $user, EntityManagerInterface $entityManager)
    {
        if (empty($user)) {
            throw $this->createNotFoundException("This user does not exist.");
        }

        return $this->render("user/user_detail.html.twig", ["user" => $user]);
    }

    /**
     * @Route("user/new/", name="user_new")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws Exception
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add("username", TextType::class)
            ->add("save", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $user->setIsActive(true);
            $user->setIsBlocked(false);
            $entityManager->persist($user);

            try {
                $entityManager->flush();

                $this->addFlash(
                    "success",
                    "User sucessfully created"
                );
            } catch (Exception $e) {
                $this->addFlash(
                    "error",
                    "Error while user creation"
                );
            }


            return $this->redirectToRoute("homepage");
        }

        return $this->render("user/user_new.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
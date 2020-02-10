<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post/{id}/show", name="post_list")
     * @param Post $post
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(Post $post, EntityManagerInterface $entityManager)
    {
        if (empty($post)) {
            throw $this->createNotFoundException("The asking post does not exist");
        }

        return $this->render("post/post_list.html.twig", ["post" => $post]);
    }

    /**
     * @Route("post/new/", name="post_new")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new Post();
        $allUser = $entityManager->getRepository(User::class)->findAll();

        $form = $this->createFormBuilder($post)
            ->add("author", ChoiceType::class, [
                "choices" => [
                    $allUser
                ],
                "choice_label" => function(User $user) {
                    return ucfirst($user->getUsername());
                },
                "choice_value" => function(User $user = null) {
                    return $user ? $user->getId() : null;
                },
            ])
            ->add("title", TextType::class)
            ->add("content", TextareaType::class)
            ->add("isPublished", ChoiceType::class, [
                "choices" => [
                    "Public" => true,
                    "Private" => false,
                ]
            ])
            ->add("save", SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Post $post */
            $post = $form->getData();
            $post->setCreatedAt(
                new \DateTime("now", new \DateTimeZone("Europe/Paris"))
            );
            $post->setIsDeleted(false);
            $entityManager->persist($post);

            try {
                $entityManager->flush();

                $this->addFlash(
                    "success",
                    "Post sucessfully created"
                );
            } catch (\Exception $e) {
                $this->addFlash(
                    "error",
                    "Error while post creation"
                );
            }


            return $this->redirectToRoute("homepage");
        }

        return $this->render("post/post_new.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
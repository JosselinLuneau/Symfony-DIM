<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Form\Type\CommentType;
use App\Form\Type\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post/{id}/show", name="post_show")
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws \Exception
     */
    public function index(Post $post, Request $request, EntityManagerInterface $entityManager)
    {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setAuthor($this->getUser());
            $comment->setCreatedAt(
                new \DateTime("now", new \DateTimeZone("Europe/Paris"))
            );
            $comment->setIsDeleted(false);
            $comment->setPost($post);

            $entityManager->persist($comment);

            try {
                $entityManager->flush();

                $this->addFlash(
                    "success",
                    "Comment created"
                );
            } catch (\Exception $e) {
                $this->addFlash(
                    "danger",
                    "Error while comment creation"
                );
            }
        }

        if (empty($post)) {
            throw $this->createNotFoundException("The asking post does not exist");
        }

        return $this->render("post/post.html.twig", ["post" => $post, "form" => $form->createView()]);
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

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Post $post */
            $post = $form->getData();
            $post->setAuthor($this->getUser());
            $post->setIsPublished(true);
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
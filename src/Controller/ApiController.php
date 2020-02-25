<?php

namespace App\Controller;



use App\Entity\Post;
use App\Entity\User;
use App\Service\FileExtensionManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/get/authors.{ext}", name="get_authors")
     * @param string $ext
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param FileExtensionManager $fileExtensionManager
     * @return Response
     */
    public function getPostAuthors(string $ext, EntityManagerInterface $entityManager, SerializerInterface $serializer, FileExtensionManager $fileExtensionManager)
    {
        if ($fileExtensionManager->isDataFormatValid($ext)) {
            $authors = $entityManager->getRepository(User::class)->findAll();

            $mimeTypes = new MimeTypes();
            $headers =  $mimeTypes->getMimeTypes(strtolower($ext));

            return new Response($serializer->serialize(
                $authors, strtolower($ext), ["groups" => ["get_authors"]]),
                Response::HTTP_OK,
                ["Content-Type" => $headers[0]]
            );
        }

        return new Response(sprintf("Le format de sortie spécifié : %s est incorrect", $ext), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/get/posts/last.{ext}", name="get_last_post")
     * @param string $ext
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param FileExtensionManager $fileExtensionManager
     * @return Response
     */
    public function getLastPost(string $ext, EntityManagerInterface $entityManager, SerializerInterface $serializer, FileExtensionManager $fileExtensionManager)
    {
        if ($fileExtensionManager->isDataFormatValid($ext, ["json", "xml"])) {
            $posts = $entityManager->getRepository(Post::class)->findLast();

            return new Response($serializer->serialize($posts, strtolower($ext)), Response::HTTP_OK);
        }

        return new Response(sprintf("Le format de sortit spécifié :\”%s≠\"'", $ext), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @route("/get/posts/top10.{ext}", name="get_top_post")
     * @param string $ext
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param FileExtensionManager $fileExtensionManager
     * @return Response
     */
    public function getTop(string $ext, EntityManagerInterface $entityManager, SerializerInterface $serializer,FileExtensionManager $fileExtensionManager)
    {
        if ($fileExtensionManager->isDataFormatValid($ext, ["json", "xml"])) {
            $posts = $entityManager->getRepository(Post::class)->findTopTen();

            dd($posts);

            return new Response($serializer->serialize($posts, strtolower($ext)), Response::HTTP_OK);
        }

        return new Response(sprintf("Le format de sortit spécifié : %s", $ext), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/get/post/{id}/comments.{ext}", name="get_post_comments")
     * @param Post $post
     * @param string $ext
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param FileExtensionManager $fileExtensionManager
     * @return Response
     */
    public function getPostComments(Post $post, string $ext, EntityManagerInterface $entityManager, SerializerInterface $serializer, FileExtensionManager $fileExtensionManager)
    {
        if ($fileExtensionManager->isDataFormatValid($ext, ["json", "xml"])) {
            return new Response($serializer->serialize($post, strtolower($ext)), Response::HTTP_OK);
        }

        return new Response(sprintf("Le format de sortit spécifié : %s", $ext), Response::HTTP_BAD_REQUEST);
    }
}
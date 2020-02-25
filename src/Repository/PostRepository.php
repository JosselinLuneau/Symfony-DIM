<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
    * @return Post[] Returns an array of Post objects
    */
    public function findLast()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.created_at', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Post[] Returns an array of Post objects
     */
    public function findTopTen()
    {
        return $this->createQueryBuilder('p')
            ->addSelect('COUNT(c.id) AS HIDDEN counter')
            ->leftjoin("p.comments", "c")
            ->orderBy('counter', "DESC")
            ->groupBy("p")
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
}

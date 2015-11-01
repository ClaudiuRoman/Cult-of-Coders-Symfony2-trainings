<?php
/**
 * Created by PhpStorm.
 * User: claudiu
 * Date: 10/19/15
 * Time: 6:16 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findArticlesSpecial($title)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.title = :title')
            ->andWhere('a.id != :id')
            ->setParameter('title', $title)
            ->orderBy('a.commentCount', 'DESC')
            ->setParameter('id', 3)
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getResult();
    }
}
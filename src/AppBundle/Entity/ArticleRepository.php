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
    public function findWithTitle($title)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.title = :title')
            ->setParameter('title', $title);

        return $qb->getQuery()->getResult();
    }
}
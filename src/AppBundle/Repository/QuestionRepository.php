<?php

namespace AppBundle\Repository;

/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllWithCategories() {
        return $this->createQueryBuilder("q")
            ->leftJoin("q.categorie", "c")
            ->addSelect("c")
            ->getQuery()
            ->getResult();
    }
    public function findAllWithOneCategories($id) {
        return $this->createQueryBuilder("q")
            ->leftJoin("q.categorie", "c")
            ->where("q.categorie = $id")
            ->addSelect("c")
            ->getQuery()
            ->getResult();
    }
}

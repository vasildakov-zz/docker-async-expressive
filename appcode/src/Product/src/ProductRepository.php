<?php declare(strict_types=1);

namespace Product;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

/**
 * Class ProductRepository
 *
 * @author     Vasil Dakov <vasildakov@gmail.com>
 */
final class ProductRepository
{
    /**
     * @var EntityManager $em
     */
    protected $em;

    /**
     * ProductRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return Query
     */
    public function fetchAll() : Query
    {
        $qb = $this->em->createQueryBuilder();

        return $qb->getQuery();
    }
}

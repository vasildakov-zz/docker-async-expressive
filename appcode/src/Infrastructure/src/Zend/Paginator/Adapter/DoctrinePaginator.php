<?php declare(strict_types=1);

namespace Infrastructure\Zend\Paginator\Adapter;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Zend\Paginator\Adapter\AdapterInterface;

class DoctrinePaginator implements AdapterInterface
{
    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * Constructor
     *
     * @param Paginator $paginator
     */
    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @param  Paginator $paginator
     * @return self
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * {@inheritDoc}
     */
    public function getItems($offset, $itemCountPerPage)
    {
        $this->paginator
            ->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($itemCountPerPage)
        ;
        return $this->paginator->getIterator();
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return $this->paginator->count();
    }
}
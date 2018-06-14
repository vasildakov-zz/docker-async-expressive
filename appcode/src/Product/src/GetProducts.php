<?php declare(strict_types=1);

namespace Product;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Fig\Http\Message\StatusCodeInterface;
use Infrastructure\Zend\Paginator\Adapter\DoctrinePaginator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class GetProducts
 *
 * @author     Vasil Dakov <vasildakov@gmail.com>
 * @todo The handle should be abstracted
 */
class GetProducts implements RequestHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * DistilleryHandler constructor.
     * @param EntityManagerInterface $em
     * @todo abstract factory?
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Handle the request and return a response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $qb = $this->em->createQueryBuilder();

        /**
         * @todo move it to the repository
         * $results = $this->repository->find($criteria);
         */
        $query = $qb
            ->select('p')
            ->from('Product\\Product', 'p')
            ->getQuery()
        ;

        /**
         * @todo the repository should return the paginator, or it should extend paginator
         */
        $adapter = new DoctrinePaginator(new Paginator($query));
        $paginator = new \Zend\Paginator\Paginator($adapter);
        $paginator->setCurrentPageNumber(1);
        $paginator->setItemCountPerPage(5);

        /**
         * @todo response payload factory
         */
        return new JsonResponse(
            [
                'data'  => $paginator->getCurrentItems(),
                'pages' => $paginator->getPages(),
            ],
            StatusCodeInterface::STATUS_OK
        );
    }
}

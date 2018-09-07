<?php

namespace App\Distillery;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Infrastructure\Zend\Paginator\Adapter\DoctrinePaginator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class GetDistilleriesHandler implements RequestHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $resourceGenerator;

    private $responseFactory;

    /**
     * DistilleryHandler constructor.
     * @param EntityManagerInterface $em
     * @todo abstract factory?
     */
    public function __construct(
        EntityManagerInterface $em,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    ) {
        $this->em = $em;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory   = $responseFactory;
    }

    /**
     * Handle the request and return a response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @todo move it to the repository
         * $results = $this->repository->find($criteria);
         */
        $qb = $this->em->createQueryBuilder();
        $query = $qb
            ->select('p')
            ->from('App\\Distillery\\Distillery', 'p')
            ->getQuery()
        ;

        /**
         * @todo the repository should return the paginator, or it should extend paginator
         */
        $adapter = new DoctrinePaginator(new Paginator($query));
        $distilleries = new DistilleryCollection($adapter);
        $distilleries->setCurrentPageNumber(1);
        $distilleries->setItemCountPerPage(10);

        return new JsonResponse($distilleries->getCurrentItems(), 200);

        /**
         * @todo response payload factory
         */
        //$resource = $this->resourceGenerator->fromObject($distilleries, $request);
        //return $this->responseFactory->createResponse($request, $resource);

    }
}
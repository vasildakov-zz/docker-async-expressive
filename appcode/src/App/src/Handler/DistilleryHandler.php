<?php declare(strict_types=1);

namespace App\Handler;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\TextResponse;
use Zend\Expressive\Hal\HalResource;
use Zend\Expressive\Hal\Link;
use Zend\Expressive\Hal\Renderer\JsonRenderer;

use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

/**
 * Class DistilleryHandler
 *
 * @see https://docs.zendframework.com/zend-expressive-hal/intro/
 */
class DistilleryHandler implements RequestHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * DistilleryHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory
    )
    {
        $this->entityManager     = $entityManager;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory   = $responseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $qb = $this->entityManager->createQueryBuilder();

        $results = $qb
            ->select('d', 'b', 'p')
            ->from('Domain\\Distillery', 'd')
            ->leftJoin('d.bottles', 'b')
            ->leftJoin('b.prices', 'p')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY)
        ;

        $collection = new ArrayCollection($results);

        return new JsonResponse(
            $collection->toArray(),
            StatusCodeInterface::STATUS_OK
        );
    }
}

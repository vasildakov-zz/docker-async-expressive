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
        $this->entityManager = $entityManager;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        /* $qb = $this->em->createQueryBuilder();
        $results = $qb
            ->select('d.id, d.name, d.description, d.status, d.founded')
            ->from('Domain\\Distillery', 'd')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $collection = new ArrayCollection($results); */


        $distillery = $this->entityManager->find('Domain\Distillery', 'cb0861ca-6d73-11e8-9223-0242ac190003');
        $resource = new HalResource($distillery->toArray());
        $resource = $resource->withLink(new Link('self'));

        //$resource = $this->resourceGenerator->fromObject($distillery, $request);
        //return $this->responseFactory->createResponse($request, $resource);

        $renderer = new JsonRenderer();

        return new TextResponse(
            $renderer->render($resource),
            StatusCodeInterface::STATUS_OK,
            ['Content-Type' => 'application/hal+json']
        );

    }
}

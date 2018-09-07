<?php declare(strict_types=1);

namespace App\Product;

use App\AbstractRestfulHandler;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Fig\Http\Message\StatusCodeInterface;
use Infrastructure\Zend\Paginator\Adapter\DoctrinePaginator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

/**
 * Class GetProducts
 *
 * @author     Vasil Dakov <vasildakov@gmail.com>
 * @todo The handle should be abstracted
 */
class GetProducts extends AbstractRestfulHandler
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
            ->from('App\\Product\\Product', 'p')
            ->getQuery()
        ;

        /**
         * @todo the repository should return the paginator, or it should extend paginator
         */
        $adapter = new DoctrinePaginator(new Paginator($query));
        $products = new ProductCollection($adapter);
        $products->setCurrentPageNumber(1);
        $products->setItemCountPerPage(10);

        $products = $paginator->getCurrentItems();
        var_dump($products); exit();

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

        //$resource = $this->resourceGenerator->fromObject($products, $request);
        //return $this->responseFactory->createResponse($request, $resource);

    }
}

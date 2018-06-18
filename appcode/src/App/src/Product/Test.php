<?php

namespace App\Product;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Test implements MiddlewareInterface
{
    public function __construct()
    {
        //exit(__CLASS__);
    }

    /**
     * Handle the request and return a response.
     */
    public function process($request, $handler): ResponseInterface
    {
        $data = [
            new Product(1, 'A', 'aaa'),
            new Product(2, 'B', 'bbb'),
        ];

        return $handler->handle($request->withAttribute('data', $data));
    }
}

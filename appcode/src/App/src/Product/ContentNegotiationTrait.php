<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 16/06/2018
 * Time: 15:54
 */

namespace Product;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

trait ContentNegotiationTrait
{
    /**
     * Handle the request and return a response.
     */
    public function createResponse($request, $instance): ResponseInterface
    {
        try {

        } catch (\Throwable $exception) {

        }
    }
}

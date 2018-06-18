<?php

namespace App;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class AbstractRestfulHandler implements RequestHandlerInterface
{

    public function __construct()
    {
    }

    /**
     * Handle the request and return a response.
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws MethodNotAllowedException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $method = strtolower($request->getMethod());
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }
        throw new MethodNotAllowedException('Method %s is not implemented for the requested resource');
    }
}

class MethodNotAllowedException extends \Exception
{

}
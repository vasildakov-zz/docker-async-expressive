<?php declare(strict_types=1);

namespace App\Handler;

use Domain\Distillery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class DistilleryHandler
 *
 * @package    App\Handler
 * @author     Vasil Dakov <vasil.dakov@dunelm.com>
 */
class DistilleryHandler implements RequestHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $macallan = new Distillery(1, 'Macallan');
        $ardbeg   = new Distillery(2, 'Ardbeg');

        return new JsonResponse(
            [
                $macallan->toArray(),
                $ardbeg->toArray()
            ]
        );
    }
}

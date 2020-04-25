<?php


namespace Coolkop\Rest\Controller;


use Coolkop\Rest\Dto\ResponseInterface;
use Coolkop\Rest\Dto\RequestInterface;
use Coolkop\Rest\Service\ServiceInterface;

interface RequestHandlerInterface
{
    /**
     * @param ServiceInterface $service
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServiceInterface $service, RequestInterface $request): ResponseInterface;
}

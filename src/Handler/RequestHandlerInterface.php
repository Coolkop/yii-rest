<?php


namespace Coolkop\Rest\Handler;


use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Dto\Request\RequestInterface;
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

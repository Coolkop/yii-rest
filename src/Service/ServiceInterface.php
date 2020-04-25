<?php


namespace Coolkop\Rest\Service;


use Coolkop\Rest\Exception\ServiceException;
use Coolkop\Rest\Exception\NotFoundException;
use Coolkop\Rest\Dto\RequestInterface;
use Coolkop\Rest\Dto\ResponseInterface;

interface ServiceInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws ServiceException
     * @throws NotFoundException
     */
    public function perform(RequestInterface $request): ResponseInterface;
}

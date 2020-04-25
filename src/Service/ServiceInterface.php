<?php


namespace Coolkop\Rest\Service;


use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Exception\NotFoundException;
use Coolkop\Rest\Exception\RepositoryException;
use Coolkop\Rest\Exception\ServiceException;

interface ServiceInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws ServiceException
     * @throws NotFoundException
     * @throws RepositoryException
     */
    public function perform(RequestInterface $request): ResponseInterface;
}

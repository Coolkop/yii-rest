<?php


namespace Coolkop\Rest\BusinessRule;


use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Exception\ServiceException;

interface BusinessRuleInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return void
     * @throws ServiceException
     */
    public function guard(RequestInterface $request): void;
}

<?php


namespace Coolkop\Rest\Service;


use Coolkop\Rest\BusinessRule\BusinessRuleInterface;
use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Dto\Response\ResponseInterface;

final class BusinessRuleDecorator implements ServiceInterface
{
    /**
     * @var ServiceInterface
     */
    private $inner;
    /**
     * @var BusinessRuleInterface
     */
    private $businessRule;

    /**
     * @param ServiceInterface $inner
     * @param BusinessRuleInterface $businessRule
     */
    public function __construct(ServiceInterface $inner, BusinessRuleInterface $businessRule)
    {
        $this->inner = $inner;
        $this->businessRule = $businessRule;
    }

    /**
     * @inheritDoc
     */
    public function perform(RequestInterface $request): ResponseInterface
    {
        $this->businessRule->guard($request);

        return $this->inner->perform($request);
    }
}

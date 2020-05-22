<?php


namespace Coolkop\Rest\BusinessRule;


use Coolkop\Rest\Dto\Request\RequestInterface;

final class Chain implements BusinessRuleInterface
{
    /**
     * @var BusinessRuleInterface[]
     */
    private $businessRuleList;

    /**
     * @param BusinessRuleInterface[] $businessRuleList
     */
    public function __construct(array $businessRuleList)
    {
        $this->businessRuleList = $businessRuleList;
    }

    /**
     * @inheritDoc
     */
    public function guard(RequestInterface $request): void
    {
        foreach ($this->businessRuleList as $businessRule) {
            $businessRule->guard($request);
        }
    }
}

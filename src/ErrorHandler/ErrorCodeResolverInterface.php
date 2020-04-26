<?php


namespace Coolkop\Rest\ErrorHandler;


use Coolkop\Rest\Enumeration\BaseEnumeration;

interface ErrorCodeResolverInterface
{
    /**
     * @param int $statusCode
     *
     * @return BaseEnumeration|null
     */
    public function resolve(int $statusCode): ?BaseEnumeration;
}

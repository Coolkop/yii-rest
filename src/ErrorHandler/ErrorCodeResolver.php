<?php


namespace Coolkop\Rest\ErrorHandler;


use Coolkop\Rest\Enumeration\BaseEnumeration;
use Coolkop\Rest\Enumeration\ErrorCode;

final class ErrorCodeResolver implements ErrorCodeResolverInterface
{
    /**
     * @inheritDoc
     */
    public function resolve(int $statusCode): ?BaseEnumeration
    {
        return $this->getMap()[$statusCode] ?? null;
    }

    /**
     * @return BaseEnumeration[]
     */
    private function getMap(): array
    {
        return [
            401 => ErrorCode::unauthorizedRequest(),
        ];
    }
}

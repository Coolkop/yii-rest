<?php


namespace Coolkop\Rest\ErrorHandler;


use Coolkop\Rest\Enumeration\ErrorCode;

final class CodeResolver
{
    /**
     * @param int $exceptionCode
     *
     * @return ErrorCode|null
     */
    public function resolve(int $exceptionCode): ?ErrorCode
    {
        return $this->getMap()[$exceptionCode] ?? null;
    }

    /**
     * @return ErrorCode[]
     */
    private function getMap(): array
    {
        return [
            401 => ErrorCode::unauthorizedRequest(),
        ];
    }
}

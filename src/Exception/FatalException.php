<?php


namespace Coolkop\Rest\Exception;


final class FatalException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function getHttpCode(): int
    {
        return 500;
    }
}

<?php


namespace Coolkop\Rest\Exception;


class ServiceException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function getHttpCode(): int
    {
        return 400;
    }
}

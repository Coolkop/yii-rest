<?php


namespace Coolkop\Rest\Exception;


class NotFoundException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function getHttpCode(): int
    {
        return 404;
    }
}

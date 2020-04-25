<?php


namespace Coolkop\Rest\Exception;


class RepositoryException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function getHttpCode(): int
    {
        return 500;
    }
}

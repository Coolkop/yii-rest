<?php


namespace Coolkop\Rest\Dto\Response;


final class EmptySuccessfulResponse implements ResponseInterface
{
    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [];
    }
}

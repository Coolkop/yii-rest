<?php


namespace Coolkop\Rest\Validator;


use Coolkop\Rest\Dto\RequestInterface;

interface AutoAssembleRequestInterface extends RequestInterface
{
    /**
     * @param mixed $data
     *
     * @return void
     */
    public function setDate(array $data): void;
}

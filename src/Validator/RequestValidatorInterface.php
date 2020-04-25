<?php


namespace Coolkop\Rest\Validator;


use Coolkop\Rest\Dto\ResponseInterface;
use Coolkop\Rest\Dto\RequestInterface;

interface RequestValidatorInterface
{
    /**
     * @return RequestInterface
     */
    public function getValidRequest(): RequestInterface;

    /**
     * @return ResponseInterface
     */
    public function getErrorResponse(): ResponseInterface;

    /**
     * @param mixed[] $data
     *
     * @return bool
     */
    public function validateRequest(array $data): bool;
}

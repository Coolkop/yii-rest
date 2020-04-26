<?php


namespace Coolkop\Rest\Validator;


use Coolkop\Rest\Dto\Request\Blank as BlankRequest;
use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Dto\Response\ErroneousResponse;
use Coolkop\Rest\Dto\Response\ResponseInterface;

final class Blank implements RequestValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function getValidRequest(): RequestInterface
    {
        return new BlankRequest();
    }

    /**
     * @inheritDoc
     */
    public function getErrorResponse(): ResponseInterface
    {
        return new ErroneousResponse();
    }

    /**
     * @inheritDoc
     */
    public function validateRequest(array $data): bool
    {
        return true;
    }
}

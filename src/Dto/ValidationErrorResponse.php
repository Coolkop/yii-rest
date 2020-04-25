<?php


namespace Coolkop\Rest\Dto;


class ValidationErrorResponse implements ResponseInterface
{
    /**
     * @var ErrorInterface[]
     */
    private $errorList = [];

    /**
     * @return ErrorInterface[]
     */
    public function getErrorList(): array
    {
        return $this->errorList;
    }

    /**
     * @param ErrorInterface[] $errorList
     *
     * @return ValidationErrorResponse
     */
    public function setErrorList(array $errorList): ValidationErrorResponse
    {
        $this->errorList = $errorList;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->errorList;
    }
}

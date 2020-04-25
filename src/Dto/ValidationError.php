<?php


namespace Coolkop\Rest\Dto;


use Coolkop\Rest\Dto\ErrorInterface;

class ValidationError implements ErrorInterface
{
    /**
     * @var string
     */
    private $attribute;

    /**
     * @var string[]
     */
    private $errorMessages;

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     *
     * @return ValidationError
     */
    public function setAttribute(string $attribute): ValidationError
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    /**
     * @param string[] $errorMessages
     *
     * @return ValidationError
     */
    public function setErrorMessages(array $errorMessages): ValidationError
    {
        $this->errorMessages = $errorMessages;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'attribute' => $this->attribute,
            'errorMessages' => $this->errorMessages,
        ];
    }
}

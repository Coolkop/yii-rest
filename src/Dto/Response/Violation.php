<?php


namespace Coolkop\Rest\Dto\Response;


use Coolkop\Rest\Service\SerializableResponseTrait;

class Violation implements ViolationInterface
{
    use SerializableResponseTrait;

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
     * @return Violation
     */
    public function setAttribute(string $attribute): Violation
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
     * @return Violation
     */
    public function setErrorMessages(array $errorMessages): Violation
    {
        $this->errorMessages = $errorMessages;

        return $this;
    }
}

<?php


namespace Coolkop\Rest\Dto;


use Coolkop\Rest\Dto\ResponseInterface;

class ErroneousResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return ErroneousResponse
     */
    public function setCode(string $code): ErroneousResponse
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return ErroneousResponse
     */
    public function setMessage(string $message): ErroneousResponse
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}

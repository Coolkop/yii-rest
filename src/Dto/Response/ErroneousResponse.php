<?php


namespace Coolkop\Rest\Dto\Response;


use Coolkop\Rest\Service\SerializableResponseTrait;

class ErroneousResponse implements ResponseInterface
{
    use SerializableResponseTrait;

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
}

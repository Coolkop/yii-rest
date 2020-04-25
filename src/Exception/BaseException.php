<?php


namespace Coolkop\Rest\Exception;


use Exception;
use Throwable;

abstract class BaseException extends Exception
{
    /**
     * @var string
     */
    private $restCode;

    /**
     * @param string $message
     * @param string $restCode
     * @param Throwable|null $previous
     */
    public function __construct(string $message, string $restCode, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);

        $this->restCode = $restCode;
    }

    /**
     * @return int
     */
    abstract public function getHttpCode(): int;

    /**
     * @return string
     */
    public function getRestCode(): string
    {
        return $this->restCode;
    }

    /**
     * @param string $restCode
     */
    public function setRestCode(string $restCode): void
    {
        $this->restCode = $restCode;
    }
}

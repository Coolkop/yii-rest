<?php


namespace Coolkop\Rest\Exception;


use Coolkop\Rest\Enumeration\BaseEnumeration;
use Exception;
use Throwable;

abstract class BaseException extends Exception
{
    /**
     * @var string
     */
    private $restCode;

    /**
     * @param BaseEnumeration $errorEnumeration
     * @param Throwable|null $previous
     */
    public function __construct(BaseEnumeration $errorEnumeration, Throwable $previous = null)
    {
        parent::__construct($errorEnumeration->getName(), 0, $previous);

        $this->restCode = $errorEnumeration->getValue();
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
}

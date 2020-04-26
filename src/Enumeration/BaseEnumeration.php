<?php


namespace Coolkop\Rest\Enumeration;


abstract class BaseEnumeration
{
    /**
     * @var string|int
     */
    private $value;

    /**
     * @param string|int $value
     */
    final public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    final public function getName(): string
    {
        return $this->getNameList()[$this->value];
    }

    /**
     * @return string|int
     */
    final public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    abstract protected function getNameList(): array;
}

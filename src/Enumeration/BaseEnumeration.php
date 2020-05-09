<?php


namespace Coolkop\Rest\Enumeration;


use Coolkop\Rest\Exception\FatalException;

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
        $this->guardValue($value);

        $this->value = $value;
    }

    /**
     * @param string|int $value
     *
     * @return static
     */
    final public static function createByValue($value): self
    {
        return new static($value);
    }

    /**
     * @param BaseEnumeration|mixed $value
     *
     * @return bool
     */
    final public function equal($value): bool
    {
        if ($value instanceof self) {
            return $this->value === $value->getValue();
        }

        return $this->value === $value;
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

    /**
     * @param string|int $value
     *
     * @return void
     * @throws FatalException
     */
    private function guardValue($value): void
    {
        if (!isset($this->getNameList()[$value])) {
            throw new FatalException(ErrorCode::unsupportedEnumerationValue());
        }
    }
}

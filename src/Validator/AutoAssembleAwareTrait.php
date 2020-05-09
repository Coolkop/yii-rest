<?php


namespace Coolkop\Rest\Validator;


trait AutoAssembleAwareTrait
{
    /**
     * @param mixed[] $data
     *
     * @return void
     */
    public function setData(array $data): void
    {
        foreach ($data as $property => $value) {
            if (property_exists(static::class, $property)) {
                $setterMethodName = sprintf('set%s', ucfirst($property));

                if (method_exists($this, $setterMethodName)) {
                    $this->{$setterMethodName}($value);
                } else {
                    $this->{$property} = $value;
                }
            }
        }
    }
}

<?php


namespace Coolkop\Rest\Validator;


trait AuthAssembleAwareTrait
{
    /**
     * @param mixed[] $data
     *
     * @return void
     */
    public function setDate(array $data): void
    {
        foreach ($data as $property => $value) {
            if (property_exists(static::class, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}

<?php


namespace Coolkop\Rest\Validator;


class RequestModifier
{
    /**
     * @param AutoAssembleRequestInterface $request
     * @param mixed[] $data
     *
     * @return void
     */
    public function modify(AutoAssembleRequestInterface $request, array $data): void
    {
        $request->setDate($data);
    }
}

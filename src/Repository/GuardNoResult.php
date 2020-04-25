<?php


namespace Coolkop\Rest\Repository;


use Coolkop\Rest\Enumeration\ErrorCode;
use Coolkop\Rest\Exception\NotFoundException;
use yii\db\ActiveRecord;

trait GuardNoResult
{
    /**
     * @param ActiveRecord|null $activeRecord
     *
     * @return void
     * @throws NotFoundException
     */
    private function guard(ActiveRecord $activeRecord = null): void
    {
        if (null === $activeRecord) {
            throw new NotFoundException(
                ErrorCode::$messages[ErrorCode::NO_RECORD_ERROR],
                ErrorCode::NO_RECORD_ERROR
            );
        }
    }
}

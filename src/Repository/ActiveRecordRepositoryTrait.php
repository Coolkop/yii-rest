<?php


namespace Coolkop\Rest\Repository;


use Coolkop\Rest\Enumeration\ErrorCode;
use Coolkop\Rest\Exception\RepositoryException;
use Throwable;
use yii\db\ActiveRecordInterface;

trait ActiveRecordRepositoryTrait
{
    /**
     * @param ActiveRecordInterface $activeRecord
     *
     * @return void
     * @throws RepositoryException
     */
    public function save(ActiveRecordInterface $activeRecord): void
    {
        try {
            $activeRecord->save(false);
        } catch (Throwable $exception) {
            throw new RepositoryException(
                ErrorCode::getMessage(ErrorCode::SAVING_ERROR),
                ErrorCode::SAVING_ERROR,
                $exception
            );
        }
    }

    /**
     * @param ActiveRecordInterface $activeRecord
     *
     * @return void
     * @throws RepositoryException
     */
    public function update(ActiveRecordInterface $activeRecord): void
    {
        try {
            $activeRecord->update(false);
        } catch (Throwable $exception) {
            throw new RepositoryException(
                ErrorCode::getMessage(ErrorCode::SAVING_ERROR),
                ErrorCode::SAVING_ERROR,
                $exception
            );
        }
    }
}

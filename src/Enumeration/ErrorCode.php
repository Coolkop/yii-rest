<?php


namespace Coolkop\Rest\Enumeration;


final class ErrorCode extends BaseEnumeration
{
    private const SAVING_ERROR = 'SAVING_ERROR';

    private const NO_RECORD_ERROR = 'NO_RECORD_ERROR';

    private const REQUEST_DATA_VALIDATION_ERROR = 'REQUEST_DATA_VALIDATION_ERROR';

    private const SERVICE_UNAVAILABLE = 'SERVICE_UNAVAILABLE';

    /**
     * @return ErrorCode
     */
    public static function savingError(): ErrorCode
    {
        return new self(self::SAVING_ERROR);
    }

    /**
     * @return ErrorCode
     */
    public static function noRecordError(): ErrorCode
    {
        return new self(self::NO_RECORD_ERROR);
    }

    /**
     * @return ErrorCode
     */
    public static function requestDataValidationError(): ErrorCode
    {
        return new self(self::REQUEST_DATA_VALIDATION_ERROR);
    }

    /**
     * @return ErrorCode
     */
    public static function serviceUnavailable(): ErrorCode
    {
        return new self(self::SERVICE_UNAVAILABLE);
    }

    /**
     * @inheritDoc
     */
    protected function getNameList(): array
    {
        return [
            self::SAVING_ERROR => 'Не удалось сохранить запись',
            self::NO_RECORD_ERROR => 'Не удалось найти запись',
            self::REQUEST_DATA_VALIDATION_ERROR => 'В запросе переданы неверные данные',
            self::SERVICE_UNAVAILABLE => 'Сервис недоступен',
        ];
    }
}

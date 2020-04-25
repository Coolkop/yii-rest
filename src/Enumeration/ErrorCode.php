<?php


namespace Coolkop\Rest\Enumeration;


final class ErrorCode
{
    public const SAVING_ERROR = 'SAVING_ERROR';

    public const NO_RECORD_ERROR = 'NO_RECORD_ERROR';

    public const REQUEST_DATA_VALIDATION_ERROR = 'REQUEST_DATA_VALIDATION_ERROR';

    private static $messages = [
        self::SAVING_ERROR => 'Не удалось сохранить запись',
        self::NO_RECORD_ERROR => 'Не удалось найти запись',
        self::REQUEST_DATA_VALIDATION_ERROR => 'В запросе переданы неверные данные',
    ];

    /**
     * @param string $code
     *
     * @return string
     */
    public static function getMessage(string $code): string
    {
        return self::$messages[$code];
    }
}

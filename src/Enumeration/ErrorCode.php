<?php


namespace Coolkop\Rest\Enumeration;


final class ErrorCode
{
    public const SAVING_ERROR = 'SAVING_ERROR';

    public const NO_RECORD_ERROR = 'NO_RECORD_ERROR';

    public static $messages = [
        self::SAVING_ERROR => 'Не удалось сохранить запись',
        self::NO_RECORD_ERROR => 'Не удалось найти запись',
    ];
}

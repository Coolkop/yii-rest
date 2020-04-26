<?php


namespace Coolkop\Rest\Logger;


use Coolkop\Rest\Enumeration\ErrorCode;
use Coolkop\Rest\Exception\FatalException;
use Exception;
use Psr\Log\LoggerInterface;
use Yii;

final class Logger implements LoggerInterface
{
    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = [])
    {
        $this->error($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = [])
    {
        $this->error($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = [])
    {
        $this->error($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = [])
    {
        $this->logException($context);

        Yii::error($message, $this->getCategory($context));
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = [])
    {
        $this->logException($context);

        Yii::warning($message, $this->getCategory($context));
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = [])
    {
        $this->warning($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = [])
    {
        $this->logException($context);

        Yii::info($message, $this->getCategory($context));
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = [])
    {
        $this->logException($context);

        Yii::debug($message, $this->getCategory($context));
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = [])
    {
        throw new FatalException(ErrorCode::serviceUnavailable());
    }

    /**
     * @param mixed[] $context
     *
     * @return void
     */
    private function logException(array $context): void
    {
        if (isset($context['exception']) && $context['exception'] instanceof Exception) {
            Yii::$app->errorHandler->logException($context['exception']);
        }
    }

    /**
     * @param mixed[] $context
     *
     * @return string|null
     */
    private function getCategory(array $context): string
    {
        return
            isset($context['category']) && is_string($context['category']) ?
                $context['category'] :
                'application';
    }
}

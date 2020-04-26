<?php


namespace Coolkop\Rest\ErrorHandler;


use Coolkop\Rest\Dto\Response\ErroneousResponse;
use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Enumeration\BaseEnumeration;
use Coolkop\Rest\Enumeration\ErrorCode;
use Yii;
use yii\base\ErrorHandler as BaseErrorHandler;
use yii\web\HttpException;

final class ErrorHandler extends BaseErrorHandler
{
    /**
     * @var string
     */
    public $errorCodeResolverClassName;

    /**
     * @inheritDoc
     */
    protected function renderException($exception)
    {
        $response = Yii::$app->getResponse();

        if ($exception instanceof HttpException) {
            $response->setStatusCode($exception->statusCode);

            $errorCode = $this->getErrorCodeResolver()->resolve($exception->statusCode);

            if (null !== $errorCode) {
                $response->data = $this->createResponseWithErrorCode($errorCode);
            } else {
                Yii::$app->errorHandler->logException($exception);

                $response->data = [
                    'code' => $exception->getCode(),
                    'status' => $exception->statusCode,
                    'name' => $exception->getName(),
                    'message' => $exception->getMessage(),
                ];
            }
        } else {
            $response->setStatusCode(500);
            $response->data = $this->createResponseWithErrorCode(ErrorCode::serviceUnavailable());
        }

        $response->send();
    }

    /**
     * @param BaseEnumeration $errorCode
     *
     * @return ResponseInterface
     */
    private function createResponseWithErrorCode(BaseEnumeration $errorCode): ResponseInterface
    {
        return (new ErroneousResponse())
            ->setMessage($errorCode->getName())
            ->setCode($errorCode->getValue());
    }

    /**
     * @return ErrorCodeResolverInterface
     */
    private function getErrorCodeResolver(): ErrorCodeResolverInterface
    {
        return Yii::createObject($this->errorCodeResolverClassName);
    }
}

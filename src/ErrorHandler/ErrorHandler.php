<?php


namespace Coolkop\Rest\ErrorHandler;


use Coolkop\Rest\Dto\Response\ErroneousResponse;
use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Enumeration\ErrorCode;
use Yii;
use yii\base\ErrorHandler as BaseErrorHandler;
use yii\web\HttpException;

final class ErrorHandler extends BaseErrorHandler
{
    /**
     * @var CodeResolver
     */
    private $codeResolver;

    /**
     * @param CodeResolver $codeResolver
     * @param array $config
     */
    public function __construct(CodeResolver $codeResolver, $config = [])
    {
        parent::__construct($config);

        $this->codeResolver = $codeResolver;
    }

    /**
     * @inheritDoc
     */
    protected function renderException($exception)
    {
        $response = Yii::$app->getResponse();

        if ($exception instanceof HttpException) {
            $response->setStatusCode($exception->statusCode);

            $errorCode = $this->codeResolver->resolve($exception->statusCode);

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
     * @param ErrorCode $errorCode
     *
     * @return ResponseInterface
     */
    private function createResponseWithErrorCode(ErrorCode $errorCode): ResponseInterface
    {
        return (new ErroneousResponse())
            ->setMessage($errorCode->getName())
            ->setCode($errorCode->getValue());
    }
}

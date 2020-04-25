<?php


namespace Coolkop\Rest\Controller;


use Coolkop\Rest\Dto\ResponseInterface;
use Coolkop\Rest\Service\ServiceInterface;
use Coolkop\Rest\Validator\RequestValidatorInterface;
use Yii;
use yii\rest\Controller;
use yii\web\Request;

abstract class ConfigurableController extends Controller
{
    /**
     * @var RequestHandlerInterface
     */
    private $requestHandler;

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->requestHandler = Yii::createObject(RequestHandlerInterface::class);
    }

    /**
     * @return ResponseInterface
     */
    final public function actionPerform(): ResponseInterface
    {
        if (!$this->getRequestValidator()->validateRequest($this->getRequestData())) {
            return $this->getRequestValidator()->getErrorResponse();
        }

        return $this->requestHandler->handle(
            $this->getService(),
            $this->getRequestValidator()->getValidRequest()
        );
    }

    /**
     * @return mixed[]
     */
    abstract protected function getRequestData(): array;

    /**
     * @return ServiceInterface
     */
    abstract protected function getService(): ServiceInterface;

    /**
     * @return RequestValidatorInterface
     */
    abstract protected function getRequestValidator(): RequestValidatorInterface;

    /**
     * @return Request
     */
    final protected function getRequest(): Request
    {
        return Yii::$app->getRequest();
    }
}

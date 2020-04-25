<?php


namespace Coolkop\Rest\Controller;


use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Extractor\RequestDataExtractorInterface;
use Coolkop\Rest\Handler\RequestHandlerInterface;
use Coolkop\Rest\Service\ServiceInterface;
use Coolkop\Rest\Validator\RequestValidatorInterface;
use Yii;
use yii\rest\Controller;

class ConfigurableController extends Controller
{
    /**
     * @var RequestValidatorInterface
     */
    public $validator;

    /**
     * @var ServiceInterface
     */
    public $service;

    /**
     * @var RequestDataExtractorInterface
     */
    public $requestDataExtractor;

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
        if (!$this->validator->validateRequest($this->extractRequestData())) {
            Yii::$app->response->setStatusCode($this->getValidationErrorStatusCode());

            return $this->validator->getErrorResponse();
        }

        return $this->requestHandler->handle(
            $this->service,
            $this->validator->getValidRequest()
        );
    }

    /**
     * @return int
     */
    protected function getValidationErrorStatusCode(): int
    {
        return 400;
    }

    /**
     * @return mixed[]
     */
    private function extractRequestData(): array
    {
        return $this->requestDataExtractor->extract(Yii::$app->getRequest());
    }
}

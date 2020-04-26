<?php


namespace Coolkop\Rest\Bootstrap\Endpoint;


use Coolkop\Rest\Controller\ConfigurableController;
use Coolkop\Rest\Extractor\RequestDataExtractorInterface;
use Coolkop\Rest\Service\ServiceInterface;
use Coolkop\Rest\Validator\RequestValidatorInterface;
use yii\base\Application;
use yii\di\Container;

abstract class BaseEndpointBootstrap implements EndpointBootstrapInterface
{
    /**
     * @inheritDoc
     */
    final public function bootstrap(Application $app, Container $container): void
    {
        $this->setAdditionalConfig($app, $container);

        $container->setSingleton(
            $this->getControllerClassName(),
            function (Container $container, $params) use ($app): ConfigurableController {
                $className = $this->getControllerClassName();

                return new $className(
                    array_shift($params), // Для контроллера первый элемент - это id контроллера
                    array_shift($params), // Второй элемент - модуль
                    [
                        'service' => $this->getService($app, $container),
                        'validator' => $this->getRequestValidator($app, $container),
                        'requestDataExtractor' => $this->getRequestDataExtractor($app, $container),
                    ]
                );
            }
        );
    }

    /**
     * @return string
     */
    abstract protected function getControllerClassName(): string;

    /**
     * @param Application $app
     * @param Container $container
     *
     * @return ServiceInterface
     */
    abstract protected function getService(Application $app, Container $container): ServiceInterface;

    /**
     * @param Application $app
     * @param Container $container
     *
     * @return RequestValidatorInterface
     */
    abstract protected function getRequestValidator(Application $app, Container $container): RequestValidatorInterface;

    /**
     * @param Application $app
     * @param Container $container
     *
     * @return RequestDataExtractorInterface
     */
    abstract protected function getRequestDataExtractor(
        Application $app,
        Container $container
    ): RequestDataExtractorInterface;

    /**
     * @param Container $container
     * @param Application $app
     *
     * @return void
     */
    protected function setAdditionalConfig(Application $app, Container $container): void
    {
        /*_*/
    }
}

<?php


namespace Coolkop\Rest\Bootstrap\Endpoint;


use Coolkop\Rest\Controller\ConfigurableController;
use Coolkop\Rest\Extractor\RequestDataExtractorInterface;
use Coolkop\Rest\Service\ServiceInterface;
use Coolkop\Rest\Validator\RequestValidatorInterface;

final class ControllerAssembleHelper
{
    /**
     * @param string $controllerName
     * @param mixed[] $params
     * @param ServiceInterface $service
     * @param RequestValidatorInterface $validator
     * @param RequestDataExtractorInterface $requestDataExtractor
     *
     * @return ConfigurableController
     */
    public static function assemble(
        string $controllerName,
        array $params,
        ServiceInterface $service,
        RequestValidatorInterface $validator,
        RequestDataExtractorInterface $requestDataExtractor
    ): ConfigurableController
    {
        return new $controllerName(
            array_shift($params), // Для контроллера первый элемент - это id контроллера
            array_shift($params), // Второй элемент - модуль
            [
                'service' => $service,
                'validator' => $validator,
                'requestDataExtractor' => $requestDataExtractor,
            ]
        );
    }
}

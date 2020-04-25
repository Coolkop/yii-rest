<?php


namespace Coolkop\Rest\Bootstrap;


use Coolkop\Rest\Handler\RequestHandler;
use Coolkop\Rest\Handler\RequestHandlerInterface;
use Yii;
use yii\base\BootstrapInterface;

class RestBootstrap implements BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(
            RequestHandlerInterface::class,
            RequestHandler::class
        );
    }
}

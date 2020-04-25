<?php


namespace Coolkop\Rest\Bootstrap;


use Coolkop\Rest\Controller\RequestHandler;
use Coolkop\Rest\Controller\RequestHandlerInterface;
use Yii;
use yii\base\BootstrapInterface;

class FrameworkBootstrap implements BootstrapInterface
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

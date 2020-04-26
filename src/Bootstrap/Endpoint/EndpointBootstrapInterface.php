<?php


namespace Coolkop\Rest\Bootstrap\Endpoint;


use yii\base\Application;
use yii\di\Container;

interface EndpointBootstrapInterface
{
    /**
     * @param Application $app
     * @param Container $container
     *
     * @return void
     */
    public function bootstrap(Application $app, Container $container): void;
}

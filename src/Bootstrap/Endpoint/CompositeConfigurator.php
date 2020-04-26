<?php


namespace Coolkop\Rest\Bootstrap\Endpoint;


use yii\base\Application;
use yii\di\Container;

final class CompositeConfigurator implements EndpointBootstrapInterface
{
    /**
     * @var EndpointBootstrapInterface[]
     */
    private $endpointBootstrapList;

    /**
     * @param EndpointBootstrapInterface[] $endpointBootstrapList
     */
    public function __construct(array $endpointBootstrapList)
    {
        $this->endpointBootstrapList = $endpointBootstrapList;
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(Application $app, Container $container): void
    {
        foreach ($this->endpointBootstrapList as $endpointBootstrap) {
            $endpointBootstrap->bootstrap($app, $container);
        }
    }
}

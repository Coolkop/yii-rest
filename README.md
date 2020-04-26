# yii-rest
Набор интерфейсов и базовых классов для организации REST API для фреймворка Yii2 (http://www.yiisoft.com)

### Описание
#### Bootstrap
В конфиг приложения подключить 
`\Coolkop\Rest\Bootstrap\RestBootstrap`

Либо реализовать собственный 
`\Coolkop\Rest\Controller\RequestHandlerInterface`

#### Добавление эндпойнта
Эндпойнт добавляется с помощью конфигурации бутстрап класса:
```php
$container->setSingleton(
    UpdateController::class,
    [
        'validator' => Yii::createObject(UpdateValidator::class),
        'service' => new TransactionalDecorator(
            Yii::createObject(UpdateService::class)
        ),
        'requestDataExtractor' => new RequestDataExtractorComposite([
            Yii::createObject(BodyParams::class),
            Yii::createObject(CurrentUserId::class),
        ]),
    ]
);
```

Или с помощью реализации
`\Coolkop\Rest\Bootstrap\Endpoint\BaseEndpointBootstrap`
и `\Coolkop\Rest\Bootstrap\Endpoint\CompositeConfigurator`

```php
final class AuthBundleBootstrap implements BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $this->getEndpointComposite()->bootstrap($app, $container);
    }

    /**
     * @return EndpointBootstrapInterface
     */
    private function getEndpointComposite(): EndpointBootstrapInterface
    {
        return new CompositeConfigurator([
            new SignUp(),
            new CheckAccess(),
        ]);
    }
}

final class SignUp extends BaseEndpointBootstrap
{
    /**
     * @inheritDoc
     */
    protected function getControllerClassName(): string
    {
        return SignUpController::class;
    }

    /**
     * @inheritDoc
     */
    protected function getService(Application $app, Container $container): ServiceInterface
    {
        return
            new MailingDecorator(
                new TransactionalDecorator(
                    new AuthAssigningDecorator(
                        Yii::createObject(Service::class),
                        Yii::createObject(ManagerInterface::class)
                    )
                ),
                Yii::createObject(UserRepository::class),
                Yii::createObject(TokenGenerator::class),
                Yii::createObject(SendActivationEmail::class),
                Yii::createObject(LoggerInterface::class)
            );
    }

    /**
     * @inheritDoc
     */
    protected function getRequestValidator(Application $app, Container $container): RequestValidatorInterface
    {
        return Yii::createObject(Validator::class);
    }

    /**
     * @inheritDoc
     */
    protected function getRequestDataExtractor(Application $app, Container $container): RequestDataExtractorInterface
    {
        return Yii::createObject(BodyParams::class);
    }

    /**
     * @inheritDoc
     */
    protected function setAdditionalConfig(Application $app, Container $container): void
    {
        $container
            ->setSingleton(
                SendActivationEmail::class,
                static function () use ($app): SendActivationEmail {
                    return new SendActivationEmail(
                        'Subject',
                        $app->get('frontendUrlManager'),
                        Yii::createObject(MessageComposer::class)
                    );
                }
            );
    }
}
```

Добавить пустой класс, реализующий
`\Coolkop\Rest\Controller\ConfigurableController`.
Это необходимо из-за проверки в Yii2 на class_exists

Реализовать валитор запроса
`\Coolkop\Rest\Validator\RequestValidatorInterface`
и класс запроса
`\Coolkop\Rest\Dto\Request\RequestInterface`

Реализовать Бизнес логику
`\Coolkop\Rest\Service\ServiceInterface`
и класс ответа
`\Coolkop\Rest\Dto\Response\ResponseInterface`

Извлечение данных для запроса необходимо собрать из существующих классов.
Или реализовать `\Coolkop\Rest\Extractor\RequestDataExtractorInterface`

#### Валидация запроса
Валидация запроса происход с помощью 
`\Coolkop\Rest\Validator\RequestValidatorInterface`

Есть базовая реализация основная на `\yii\base\Model`

Она предоставляет механизм сборки объекта запроса после валидации. 
Для этого объект запроса должен реализовывать
`\Coolkop\Rest\Validator\AutoAssembleRequestInterface`

Так же этот валидабор предоставляет сборку ответа с ошибками валидации
`\Coolkop\Rest\Dto\Response\ValidationErrorResponse`

##### Бизнес логика
Предполагается реализовывать логику в сервисном слое.
По одному сервису на одно действие.
Для этого необходимо реализовать 
`\Coolkop\Rest\Service\ServiceInterface`

Класс ответа эндпойнта должен реализовывать
`\Coolkop\Rest\Dto\Response\ResponseInterface`

Для автосериализации на основе рефлекции есть трейт
`\Coolkop\Rest\Service\SerializableResponseTrait`

#### Обработка ошибок
Для приведения ошибок Yii2 к стандарнтному для этой библиотеки виду можно подключить 
`\Coolkop\Rest\ErrorHandler\ErrorHandler`

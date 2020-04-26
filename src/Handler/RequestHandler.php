<?php


namespace Coolkop\Rest\Handler;


use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Dto\Response\ErroneousResponse;
use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Exception\NotFoundException;
use Coolkop\Rest\Exception\RepositoryException;
use Coolkop\Rest\Exception\ServiceException;
use Coolkop\Rest\Service\ServiceInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Yii;

class RequestHandler implements RequestHandlerInterface
{
    use LoggerAwareTrait;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->setLogger($logger);
    }

    /**
     * @inheritDoc
     */
    public function handle(ServiceInterface $service, RequestInterface $request): ResponseInterface
    {
        try {
            return $service->perform($request);
        } catch (ServiceException | NotFoundException | RepositoryException $exception) {
            $this->logger->warning($exception->getMessage(), ['exception' => $exception]);

            Yii::$app->response->setStatusCode($exception->getHttpCode());

            return (new ErroneousResponse())
                ->setCode($exception->getRestCode())
                ->setMessage($exception->getMessage());
        }
    }
}

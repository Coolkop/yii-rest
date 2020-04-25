<?php


namespace Coolkop\Rest\Controller;


use Coolkop\Rest\Dto\ErroneousResponse;
use Coolkop\Rest\Dto\ResponseInterface;
use Coolkop\Rest\Exception\RepositoryException;
use Coolkop\Rest\Exception\ServiceException;
use Coolkop\Rest\Exception\NotFoundException;
use Coolkop\Rest\Controller\RequestHandlerInterface;
use Coolkop\Rest\Dto\RequestInterface;
use Coolkop\Rest\Service\ServiceInterface;
use Yii;

class RequestHandler implements RequestHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(ServiceInterface $service, RequestInterface $request): ResponseInterface
    {
        try {
            return $service->perform($request);
        } catch (ServiceException | NotFoundException | RepositoryException $exception) {
            Yii::$app->errorHandler->logException($exception);
            Yii::$app->response->setStatusCode($exception->getHttpCode());

            return (new ErroneousResponse())
                ->setCode($exception->getRestCode())
                ->setMessage($exception->getMessage());
        }
    }
}

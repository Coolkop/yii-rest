<?php


namespace Coolkop\Rest\Controller;


use Coolkop\Rest\Dto\ErroneousResponse;
use Coolkop\Rest\Dto\ResponseInterface;
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
        } catch (ServiceException $exception) {
            Yii::$app->errorHandler->handleException($exception);
            Yii::$app->response->setStatusCode(400);

            return (new ErroneousResponse())
                ->setCode($exception->getCode())
                ->setMessage($exception->getMessage());
        } catch (NotFoundException $exception) {
            Yii::$app->response->setStatusCode(404);

            return (new ErroneousResponse())
                ->setCode($exception->getCode())
                ->setMessage($exception->getMessage());
        }
    }
}

<?php


namespace Coolkop\Rest\Service;


use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Dto\Response\ResponseInterface;
use Throwable;
use Yii;

final class TransactionalDecorator implements ServiceInterface
{
    /**
     * @var ServiceInterface
     */
    private $inner;

    /**
     * @param ServiceInterface $inner
     */
    public function __construct(ServiceInterface $inner)
    {
        $this->inner = $inner;
    }

    /**
     * @inheritDoc
     */
    public function perform(RequestInterface $request): ResponseInterface
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $response = $this->inner->perform($request);
            $transaction->commit();

            return $response;
        } catch (Throwable $e) {
            $transaction->rollBack();

            throw $e;
        }
    }
}

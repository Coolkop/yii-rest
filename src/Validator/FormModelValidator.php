<?php


namespace Coolkop\Rest\Validator;


use Coolkop\Rest\Dto\ErrorInterface;
use Coolkop\Rest\Dto\ValidationError;
use Coolkop\Rest\Dto\ValidationErrorResponse;
use Coolkop\Rest\Dto\RequestInterface;
use Coolkop\Rest\Validator\RequestValidatorInterface;
use Coolkop\Rest\Dto\ResponseInterface;
use yii\base\Model;

abstract class FormModelValidator extends Model implements RequestValidatorInterface
{
    /**
     * @var RequestModifier
     */
    private $requestModifier;

    /**
     * @param RequestModifier $requestModifier
     * @param array $config
     */
    public function __construct(RequestModifier $requestModifier, array $config = [])
    {
        parent::__construct($config);

        $this->requestModifier = $requestModifier;
    }

    /**
     * @inheritDoc
     */
    public function getValidRequest(): RequestInterface
    {
        $request = $this->getAutoAssembleRequest();

        $this->requestModifier->modify($request, $this->getAttributes());

        return $request;
    }

    /**
     * @inheritDoc
     */
    public function getErrorResponse(): ResponseInterface
    {
        return (new ValidationErrorResponse())
            ->setErrorList(
                $this->createErrorList()
            );
    }

    /**
     * @inheritDoc
     */
    public function validateRequest(array $data): bool
    {
        $this->setAttributes($data, false);

        return $this->validate();
    }

    /**
     * @return AutoAssembleRequestInterface
     */
    abstract protected function getAutoAssembleRequest(): AutoAssembleRequestInterface;

    /**
     * @return ErrorInterface[]
     */
    private function createErrorList(): array
    {
        $errorList = [];

        foreach ($this->getErrors() as $attribute => $errorMessages) {
            $errorList[] = $this->createError($attribute, $errorMessages);
        }

        return $errorList;
    }

    /**
     * @param string $attribute
     * @param string[] $errorMessages
     *
     * @return ErrorInterface
     */
    private function createError(string $attribute, array $errorMessages): ErrorInterface
    {
        return (new ValidationError())
            ->setAttribute($attribute)
            ->setErrorMessages($errorMessages);
    }
}

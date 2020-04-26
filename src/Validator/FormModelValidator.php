<?php


namespace Coolkop\Rest\Validator;


use Coolkop\Rest\Dto\Request\RequestInterface;
use Coolkop\Rest\Dto\Response\ResponseInterface;
use Coolkop\Rest\Dto\Response\Violation;
use Coolkop\Rest\Dto\Response\ViolationInterface;
use Coolkop\Rest\Dto\Response\ViolationListResponse;
use Coolkop\Rest\Enumeration\ErrorCode;
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
        $error = ErrorCode::requestDataValidationError();

        return (new ViolationListResponse())
            ->setCode($error->getValue())
            ->setMessage($error->getName())
            ->setViolationList(
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
     * @return ViolationInterface[]
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
     * @return ViolationInterface
     */
    private function createError(string $attribute, array $errorMessages): ViolationInterface
    {
        return (new Violation())
            ->setAttribute($attribute)
            ->setErrorMessages($errorMessages);
    }
}

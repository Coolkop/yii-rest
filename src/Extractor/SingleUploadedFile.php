<?php


namespace Coolkop\Rest\Extractor;


use yii\web\Request;
use yii\web\UploadedFile;

final class SingleUploadedFile implements RequestDataExtractorInterface
{
    private const DEFAULT_FIELD_NAME = 'file';

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @param string|null $fieldName
     */
    public function __construct(string $fieldName = null)
    {
        $this->fieldName = $fieldName ?? self::DEFAULT_FIELD_NAME;
    }

    /**
     * @inheritDoc
     */
    public function extract(Request $request): array
    {
        // Метод вызывает парсинг запроса. Это обязательно, чтобы UploadedFile смог инстанцироваться
        $request->getBodyParams();

        return [$this->fieldName => UploadedFile::getInstanceByName($this->fieldName)];
    }
}

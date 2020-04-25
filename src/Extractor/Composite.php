<?php


namespace Coolkop\Rest\Extractor;


use yii\web\Request;

final class Composite implements RequestDataExtractorInterface
{
    /**
     * @var RequestDataExtractorInterface[]
     */
    private $extractorList;

    /**
     * @param RequestDataExtractorInterface[] $extractorList
     */
    public function __construct(array $extractorList)
    {
        $this->extractorList = $extractorList;
    }

    /**
     * @inheritDoc
     */
    public function extract(Request $request): array
    {
        $dataList = [];

        foreach ($this->extractorList as $extractor) {
            $dataList[] = $extractor->extract($request);
        }

        return !empty($dataList) ? array_merge(...$dataList) : [];
    }
}

<?php


namespace Coolkop\Rest\Extractor;


use yii\web\Request;

final class Blank implements RequestDataExtractorInterface
{
    /**
     * @inheritDoc
     */
    public function extract(Request $request): array
    {
        return [];
    }
}

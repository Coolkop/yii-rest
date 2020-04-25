<?php


namespace Coolkop\Rest\Extractor;


use yii\web\Request;

final class BodyParams implements RequestDataExtractorInterface
{
    /**
     * @inheritDoc
     */
    public function extract(Request $request): array
    {
        return $request->getBodyParams();
    }
}

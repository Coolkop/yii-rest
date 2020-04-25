<?php


namespace Coolkop\Rest\Extractor;


use yii\web\Request;

final class GetParams implements RequestDataExtractorInterface
{
    /**
     * @inheritDoc
     */
    public function extract(Request $request): array
    {
        $data = [];

        foreach ($request->get() as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}

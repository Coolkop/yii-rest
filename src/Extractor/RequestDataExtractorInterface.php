<?php


namespace Coolkop\Rest\Extractor;


use yii\web\Request;

interface RequestDataExtractorInterface
{
    /**
     * @param Request $request
     *
     * @return mixed[]
     */
    public function extract(Request $request): array;
}

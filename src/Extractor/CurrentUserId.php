<?php


namespace Coolkop\Rest\Extractor;


use Yii;
use yii\web\Request;

final class CurrentUserId implements RequestDataExtractorInterface
{
    /**
     * @inheritDoc
     */
    public function extract(Request $request): array
    {
        return [
            'userId' => !Yii::$app->user->isGuest ? Yii::$app->user->id : null
        ];
    }
}

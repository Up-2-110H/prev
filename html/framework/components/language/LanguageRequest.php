<?php

namespace app\components\language;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Request;

/**
 * Class LanguageRequest
 *
 * @package app\components\language
 */
class LanguageRequest extends Request
{
    /**
     * @return bool|string
     */
    protected function resolveRequestUri()
    {
        $pattern = [];
        $resolveRequestUri = parent::resolveRequestUri();

        if (Yii::$app->getUrlManager()->enablePrettyUrl === true && Yii::$app->getUrlManager()->suffix) {
            $pattern[] = '/' . preg_replace('/\//', '\/', Yii::$app->getUrlManager()->suffix) . '$/';
        }

        if (Yii::$app->getUrlManager()->showScriptName === true) {
            $pattern[] = '/' . preg_replace('/\//', '\/', $this->getScriptUrl()) . '/';
        }

        $requestUri = preg_replace($pattern, '', $resolveRequestUri);

        list($language,) = explode('/', trim($requestUri, '/'));

        if (Yii::$app->get('language')->has($language)) {
            Yii::$app->language = $language;
        } else {
            Yii::$app->language = $this->getPreferredLanguage(ArrayHelper::getColumn(Yii::$app->get('language')->getList(),
                'iso'));
        }

        return $resolveRequestUri;
    }
}

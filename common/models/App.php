<?php

namespace common\models;

/**
 * Class App
 * @package common\models
 */
class App
{
    /**
     * @return null|object
     * @throws \yii\base\InvalidConfigException
     */
    public static function planningService()
    {
        return \Yii::$app->get('planningService');
    }
}
<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Attribute
 * @package common\models
 *
 * @property int id
 * @property string name
 */
class Attribute extends ActiveRecord
{
    /**
     * @inheritdoc
     * @return string
     */
    public static function tableName()
    {
        return 'attribute';
    }
}
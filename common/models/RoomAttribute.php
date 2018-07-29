<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class RoomAttribute
 * @package common\models
 *
 * @property int id
 * @property int room_id
 * @property int attribute_id
 */
class RoomAttribute extends ActiveRecord
{
    public static function tableName()
    {
        return 'room_attribute';
    }
}
<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class MeetingRoom
 * @package common\models
 *
 * @property int id
 * @property string name
 * @property int capacity
 */
class MeetingRoom extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting_room';
    }

    public function getExistAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])
            ->via('roomAttributes');
    }

    public function getRoomAttributes()
    {
        return $this->hasMany(RoomAttribute::className(), ['room_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}

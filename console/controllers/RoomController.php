<?php

namespace console\controllers;

use common\models\Attribute;
use common\models\RoomAttribute;
use Faker\Factory;

class RoomController extends \yii\console\Controller
{
    public function actionGenerate($count)
    {
        $numbers = range(0, $count);
        $faker = Factory::create();
        foreach ($numbers as $number) {
            $room = new \common\models\MeetingRoom();
            $room->name = $faker->word;
            $room->save(false);
        }
    }

    public function actionGenerateAttributes()
    {
        $attributes = ['projector', 'table', 'conference call'];
        foreach ($attributes as $roomAttribute) {
            $attribute = new Attribute();
            $attribute->name = $roomAttribute;
            $attribute->save(false);
        }
    }

    public function actionReferenceRoomAttribute($roomId, $attributeId)
    {
        $roomAttribute = new RoomAttribute();
        $roomAttribute->room_id = $roomId;
        $roomAttribute->attribute_id = $attributeId;
        $roomAttribute->save(false);
    }
}
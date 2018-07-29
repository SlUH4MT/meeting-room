<?php
namespace frontend\models;

use common\models\MeetingRoom;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class RoomSearchForm extends Model
{
    public function getQuery()
    {
        return MeetingRoom::find();
    }

    public function search()
    {
        $query = $this->getQuery();
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }
}
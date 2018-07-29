<?php

namespace frontend\models;

use common\models\Meeting;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class MeetingSearchForm
 * @package frontend\models
 */
class MeetingSearchForm extends Model
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuery()
    {
        return Meeting::find();
    }

    /**
     * @return ActiveDataProvider
     */
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
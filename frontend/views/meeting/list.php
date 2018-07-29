<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;

echo 'List of meeting';
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'label' => 'User',
            'attribute' => 'user_id',
            'format' => 'raw',
            'value' => function (\common\models\Meeting $model) {
                return $model->user ? $model->user->username : '';
            }
        ],
        [
            'label' => 'Room',
            'attribute' => 'room_id',
            'value' => function (\common\models\Meeting $model) {
                return 'Room №' . $model->room_id;
            }
        ],
        'begin_time',
        'end_time',
        'meeting_date',
        [
            'class' => ActionColumn::className(),
            'template' => "{cancel}",
            'buttons' => [
                'cancel' => function ($url, $model, $key) {
                    return Html::a('Cancel', $url);
                },
            ]
        ],
    ],
]);
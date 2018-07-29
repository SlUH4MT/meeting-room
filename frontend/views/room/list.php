<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;

echo 'Комнаты совещаний';
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        [
            'header'=>'Attributes',
            'content' => function (\common\models\MeetingRoom $room) {
                $attributes = $room->existAttributes;
                $content = [];
                /** @var \common\models\Attribute $attr*/
                foreach ($attributes as $attr) {
                    $content[] = $attr->name;
                }
                return implode(", ", $content);
            }
        ],
        [
            'class' => ActionColumn::className(),
            'template' => "{edit}<br>{plan}",
            'buttons' => [
                'edit' => function ($url, $model, $key) {
                    return Html::a('Edit', $url);
                },
                'plan' => function ($url, $model, $key) {
                    return Html::a('Plan', $url);
                },
            ]
        ],
    ],
]);

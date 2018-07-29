<?php

use kartik\time\TimePicker;
use yii\helpers\Html;

echo Html::beginTag('div', [
    'class' => 'row'
]);
$form = \yii\bootstrap\ActiveForm::begin([
    'layout' => 'horizontal',
    'id' => 'plan-form',
    'options' => [
        'class' => 'form-horizontal',
    ],
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'offset' => 'col-sm-offset-0',
            'wrapper' => 'col-sm-4',
            'error' => '',
            'hint' => '',
        ],
    ],
]);

echo $form->field($meeting, 'meeting_date')->widget(\kartik\date\DatePicker::className(), [
    'type'=> \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true
    ]
]);
echo $form->field($meeting, 'begin_time')->widget(TimePicker::className(), [
    'pluginOptions' => [
        'showSeconds' => false,
        'minuteStep' => 15,
        'showInputs' => false
    ]
]);
echo $form->field($meeting, 'end_time')->widget(TimePicker::className(), [
    'pluginOptions' => [
        'showSeconds' => false,
        'minuteStep' => 15,
        'showInputs' => false
    ]
]); ?>

<div class="col-sm-4 col-sm-offset-2">
    <?php echo Html::submitButton('Plan', ['class' => 'btn btn-primary']); ?>
</div>

<?php \yii\bootstrap\ActiveForm::end();
echo Html::endTag('div');

<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

echo 'Комната';

echo yii\authclient\widgets\AuthChoice::widget([
    'baseAuthUrl' => ['site/auth'],
    'popupMode' => false,
]);
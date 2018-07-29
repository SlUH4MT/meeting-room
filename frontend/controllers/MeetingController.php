<?php

namespace frontend\controllers;

use frontend\models\MeetingSearchForm;
use yii\web\Controller;

class MeetingController extends Controller
{
    public function actionList()
    {
        $search = new MeetingSearchForm();
        return $this->render('list', ['dataProvider' => $search->search()]);
    }
}
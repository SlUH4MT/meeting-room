<?php

namespace frontend\controllers;

use common\models\Meeting;
use common\models\MeetingRoom;
use frontend\models\RoomSearchForm;
use yii\web\Controller;

class RoomController extends Controller
{
    public function actionList()
    {
        $searchForm = new RoomSearchForm();
        return $this->render('list', [
            'dataProvider' => $searchForm->search()
        ]);
    }

    public function actionEdit($id)
    {
        $room = MeetingRoom::findOne($id);
        if (\Yii::$app->request->isPost) {
            if ($room->load(\Yii::$app->request->post()) && $room->validate()) {
                $room->save();
                return $this->redirect('list');
            }
        }
        return $this->render('edit', ['model' => $room]);
    }

    public function actionPlan($id)
    {
        $room = MeetingRoom::findOne($id);
        $meeting = new Meeting();
        if (\Yii::$app->request->isPost) {
            if ($meeting->load(\Yii::$app->request->post()) && $meeting->validate()) {
                $meeting->user_id = \Yii::$app->user->id;
                $meeting->room_id = $room->id;
                $meeting->save();
                return $this->redirect('/meeting/list');
            }
        }
        return $this->render('plan', ['room' => $room, 'meeting' => $meeting]);
    }
}
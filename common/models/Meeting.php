<?php

namespace common\models;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * Class Meeting
 * @package common\models
 *
 * @property int id
 * @property int user_id
 * @property int room_id
 * @property string status
 * @property string begin_time
 * @property string end_time
 * @property string meeting_date
 *
 * @property \dektrium\user\models\User user
 * @property MeetingRoom room
 */
class Meeting extends ActiveRecord
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DELETED = 'deleted';

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'meeting';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['meeting_date', 'end_time', 'begin_time'], 'string'],
            [['meeting_date', 'end_time', 'begin_time'], 'required'],
            ['begin_time', 'validateBeginTime'],
            ['end_time', 'validateEndTime']
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'meeting_date',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'meeting_date',
                ],
                'value' => function ($event) {
                     return (new \DateTime($this->meeting_date))->format('Y-m-d');
                },
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(MeetingRoom::className(), ['id' => 'room_id']);
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateBeginTime($attribute, $params)
    {
        $dateTime = new \DateTime($this->$attribute);
        $timeStamp = $dateTime->getTimestamp();

        if ($timeStamp % 300 !== 0) {
            $this->addError($attribute, 'Время должно быть кратное четверти часа');
        }
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateEndTime($attribute, $params)
    {
        $beginTime = new \DateTime($this->begin_time);
        $endTime = new \DateTime($this->$attribute);
        $timeStamp = $endTime->getTimestamp();
        $beginTimestamp = $beginTime->getTimestamp();

        if ($timeStamp % 300 !== 0) {
            $this->addError($attribute, 'Время должно быть кратное четверти часа');
        }
        if (($timeStamp-$beginTimestamp) < 30*60) {
            $this->addError($attribute, 'Минимальный интервал 30 минут');
        }
    }

    /**
     * @param $beginTime
     * @param $endTime
     * @return bool
     */
    public function isAlreadyExist($beginTime, $endTime)
    {
        $batchMeetings = self::find()
            ->where([
                'meeting_date' => $this->meeting_date,
                'room_id' => $this->room_id,
                'status' => self::STATUS_ACTIVE
            ])->batch();
        $planBeginDateTime = (new \DateTime($this->meeting_date . ' ' . $beginTime))->getTimestamp();
        $planEndDateTime = (new \DateTime($this->meeting_date . ' ' . $endTime))->getTimestamp();
        /**
         * @var Meeting $meeting
         */
        foreach ($batchMeetings as $meetings) {
            foreach ($meetings as $meeting) {
                $existBeginTime = $meeting->begin_time;
                $existEndTime = $meeting->end_time;
                $date = $meeting->meeting_date;
                $existBeginDateTime = (new \DateTime($date . ' ' . $existBeginTime))->getTimestamp();
                $existEndDateTime = (new \DateTime($date . ' ' . $existEndTime))->getTimestamp();
                if ($planBeginDateTime === $existBeginDateTime || $planEndDateTime === $existEndDateTime) {
                    return true;
                }
                if ($planBeginDateTime > $existBeginDateTime && $planBeginDateTime < $existEndDateTime) {
                    return true;
                }
                if ($planEndDateTime > $existBeginDateTime && $planEndDateTime < $existEndDateTime) {
                    return true;
                }
            }
        }
        return false;
    }
}

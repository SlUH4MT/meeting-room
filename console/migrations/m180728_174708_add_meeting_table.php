<?php

use common\models\Migration;

/**
 * Class m180728_174708_add_meeting_table
 */
class m180728_174708_add_meeting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('meeting', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'room_id' => $this->integer(),
            'status' => $this->string(),
            'begin_datetime' => $this->dateTime(),
            'end_datetime' => $this->dateTime()
        ], $this->tableOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('meeting');
    }
}

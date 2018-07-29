<?php

use common\models\Migration;

/**
 * Class m180728_154505_add_meeting_room_table
 */
class m180728_154505_add_meeting_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('meeting_room', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'capacity' => $this->integer()
        ], $this->tableOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('meeting_room');
    }
}

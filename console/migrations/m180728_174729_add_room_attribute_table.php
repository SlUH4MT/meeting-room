<?php

use common\models\Migration;

/**
 * Class m180728_174729_add_room_attribute_table
 */
class m180728_174729_add_room_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('room_attribute', [
            'id' => $this->primaryKey(),
            'room_id' => $this->integer(),
            'attribute_id' => $this->integer(),
        ], $this->tableOptions());

        $this->addForeignKey('fk-room_id-id', 'room_attribute', 'room_id', 'meeting_room', 'id');
        $this->addForeignKey('fk-attribute_id-id', 'room_attribute', 'attribute_id', 'attribute', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('room_attribute');
    }
}

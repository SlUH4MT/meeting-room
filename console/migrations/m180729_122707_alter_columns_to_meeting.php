<?php

use yii\db\Migration;

/**
 * Class m180729_122707_alter_columns_to_meeting
 */
class m180729_122707_alter_columns_to_meeting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('meeting', 'begin_datetime', 'begin_time');
        $this->alterColumn('meeting', 'begin_time', $this->string());
        $this->renameColumn('meeting', 'end_datetime', 'end_time');
        $this->alterColumn('meeting', 'end_time', $this->string());
        $this->addColumn('meeting', 'meeting_date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180729_122707_alter_columns_to_meeting cannot be reverted.\n";

        return false;
    }
}

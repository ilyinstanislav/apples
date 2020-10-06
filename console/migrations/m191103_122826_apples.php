<?php

use yii\db\Migration;

/**
 * Class m191103_122826_apples
 */
class m191103_122826_apples extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apples', [
            'id' => $this->primaryKey(),
            'color' => $this->integer(11)->notNull(),
            'dt_create' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'dt_fall' => $this->dateTime()->null(),
            'status' => $this->integer(11)->notNull()->defaultValue(0),
            'eaten' => $this->decimal(10, 2)->notNull()->defaultValue(0.00),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apples');
    }
}

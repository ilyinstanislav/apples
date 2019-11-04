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
        $this->execute("
            CREATE TABLE apple.apples (
                id int(11) NOT NULL AUTO_INCREMENT,
                color int(11) NOT NULL,
                dt_create timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                dt_fall datetime DEFAULT NULL,
                status int(11) NOT NULL DEFAULT 0,
                eaten decimal(10, 2) NOT NULL DEFAULT 0.00,
                PRIMARY KEY (id)
            )
            ENGINE = INNODB,
            CHARACTER SET utf8,
            COLLATE utf8_general_ci;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191103_122826_apples cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191103_122826_apples cannot be reverted.\n";

        return false;
    }
    */
}

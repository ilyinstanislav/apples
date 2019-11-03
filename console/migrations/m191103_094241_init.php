<?php

use yii\db\Migration;

/**
 * Class m191103_094241_init
 */
class m191103_094241_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //set user admin/qwe
        $this->execute("
            INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
            (1, 'admin', 'W29QvVM8EtICpfaE61751U7eQY4Ql9GV', '$2y$13\$W1l9EwFecIVToNL6M1nsWuaILI1m3DtbvqaloBn0X4Z3KTuBg7boq', 'admin@admin.ru', 1, 1537792899, 1550738528, NULL);
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191103_094241_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191103_094241_init cannot be reverted.\n";

        return false;
    }
    */
}

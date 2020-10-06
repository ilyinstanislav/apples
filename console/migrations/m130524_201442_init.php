<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'verification_token' => $this->string()->defaultValue(null),
        ]);

        $this->insert('user', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => 'W29QvVM8EtICpfaE61751U7eQY4Ql9GV',
            'password_hash' => '$2y$13\$W1l9EwFecIVToNL6M1nsWuaILI1m3DtbvqaloBn0X4Z3KTuBg7boq',
            'email' => 'admin@admin.ru',
            'status' => 10,
            'created_at' => 1537792899,
            'updated_at' => 1550738528,
            'verification_token' => NULL,
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}

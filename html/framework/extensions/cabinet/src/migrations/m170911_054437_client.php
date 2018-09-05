<?php

use yii\db\Migration;

class m170911_054437_client extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(64)->notNull(),
            'password' => $this->string(60)->notNull(),
            'authKey' => $this->string(128)->notNull(),
            'accessToken' => $this->string(128)->notNull(),
            'blocked' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('login', '{{%client}}', ['login'], true);
        $this->createIndex('blocked', '{{%client}}', ['blocked']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}

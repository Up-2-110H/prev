<?php

use yii\db\Migration;

class m170911_055836_client_oauth extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%client_oauth}}', [
            'id' => $this->primaryKey(),
            'clientId' => $this->integer(11)->notNull(),
            'source' => $this->string(128)->notNull(),
            'sourceId' => $this->string(128)->notNull(),
        ], $options);

        $this->createIndex('clientId', '{{%client_oauth}}', ['clientId']);
        $this->addForeignKey(
            'client_oauth_clientId_client_id',
            '{{%client_oauth}}',
            ['clientId'],
            '{{%client}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('client_oauth_clientId_client_id', '{{%client_oauth}}');
        $this->dropTable('{{%client_oauth}}');
    }
}

<?php

use yii\db\Migration;

class m170911_054655_client_log extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%client_log}}', [
            'id' => $this->primaryKey(),
            'clientId' => $this->integer(11)->null()->defaultValue(null),
            'status' => $this->smallInteger(1)->notNull(),
            'ip' => $this->bigInteger(20)->null()->defaultValue(null),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('clientId', '{{%client_log}}', ['clientId']);
        $this->addForeignKey(
            'client_log_clientId_client_id',
            '{{%client_log}}',
            ['clientId'],
            '{{%client}}',
            ['id'],
            'SET NULL',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('client_log_clientId_client_id', '{{%client_log}}');
        $this->dropTable('{{%client_log}}');
    }
}

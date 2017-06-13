<?php

use yii\db\Migration;

class m170613_062205_example extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable(
            '{{%example}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(128)->notNull(),
                'text' => $this->text()->notNull(),
                'hidden' => $this->smallInteger(1)->notNull()->defaultValue(1),
                'language' => $this->string(8)->null()->defaultValue(null),
                'created_at' => $this->dateTime()->null()->defaultValue(null),
                'updated_at' => $this->dateTime()->null()->defaultValue(null),
            ],
            $options
        );

        $this->createIndex('hidden', '{{%example}}', ['hidden']);
        $this->createIndex('language', '{{%example}}', ['language']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%example}}');
    }
}

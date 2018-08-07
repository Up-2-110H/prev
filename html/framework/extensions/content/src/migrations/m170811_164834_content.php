<?php

use yii\db\Migration;

class m170811_164834_content extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%content}}', [
            'id' => $this->primaryKey(),
            'alias' => $this->string(64)->notNull(),
            'title' => $this->string(128)->notNull(),
            'text' => $this->text()->notNull(),
            'layout' => $this->string(64)->notNull(),
            'view' => $this->string(64)->notNull(),
            'hidden' => $this->smallInteger(1)->notNull(),
            'language' => $this->string(8)->notNull(),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-unique', '{{%content}}', ['alias', 'language'], true);
        $this->createIndex('idx-alias-hidden-language', '{{%content}}', ['alias', 'hidden', 'language']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%content}}');
    }
}

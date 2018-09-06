<?php

use yii\db\Migration;

/**
 * Class m180906_062729_news
 */
class m180906_062729_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'date' => $this->dateTime()->null()->defaultValue(null),
            'announce' => $this->text()->null()->defaultValue(null),
            'text' => $this->text()->notNull(),
            'hidden' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createdBy' => $this->integer(11)->null()->defaultValue(null),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-date', '{{%news}}', 'date');
        $this->createIndex('idx-hidden', '{{%news}}', 'hidden');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}

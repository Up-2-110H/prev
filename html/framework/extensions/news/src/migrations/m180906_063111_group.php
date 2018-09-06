<?php

use yii\db\Migration;

/**
 * Class m180906_063111_group
 */
class m180906_063111_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%news_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'language' => $this->string(8)->null()->defaultValue(null),
            'hidden' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createdBy' => $this->integer(11)->null()->defaultValue(null),
            'createdAt' => $this->dateTime()->notNull()->defaultValue(null),
            'updatedAt' => $this->dateTime()->notNull()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-language', '{{%news_group}}', 'language');
        $this->createIndex('idx-hidden', '{{%news_group}}', 'hidden');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news_group}}');
    }
}

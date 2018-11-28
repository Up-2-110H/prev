<?php

use yii\db\Migration;

/**
 * Class m181125_234518_survey
 */
class m181125_234518_survey extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%survey}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(256)->notNull(),
            'hidden' => $this->smallInteger(1)->notNull(),
            'language' => $this->string(8)->notNull(),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-hidden-language', '{{%survey}}', ['hidden', 'language']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%survey}}');
    }
}

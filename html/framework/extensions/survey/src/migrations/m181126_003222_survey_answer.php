<?php

use yii\db\Migration;

/**
 * Class m181126_003222_survey_answer
 */
class m181126_003222_survey_answer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%survey_answer}}', [
            'id' => $this->primaryKey(),
            'questionId' => $this->integer()->notNull(),
            'title' => $this->string(256)->notNull(),
            'hidden' => $this->smallInteger(1)->notNull(),
            'position' => $this->integer()->null()->defaultValue(null),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-questionId', '{{%survey_answer}}', ['questionId']);
        $this->createIndex('idx-questionId-hidden', '{{%survey_answer}}', ['questionId', 'hidden']);
        $this->createIndex('idx-position', '{{%survey_answer}}', ['position']);

        $this->addForeignKey('fk-question', '{{%survey_answer}}', 'questionId', '{{%survey_question}}', 'id', 'CASCADE',
            'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-question', '{{%survey_answer}}');
        $this->dropTable('{{%survey_answer}}');
    }
}

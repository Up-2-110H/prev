<?php

use yii\db\Migration;

/**
 * Class m181126_000606_survey_question
 */
class m181126_000606_survey_question extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%survey_question}}', [
            'id' => $this->primaryKey(),
            'surveyId' => $this->integer()->notNull(),
            'type' => $this->string(256)->notNull(),
            'title' => $this->string(256)->notNull(),
            'hint' => $this->string(256)->notNull(),
            'hidden' => $this->smallInteger(1)->notNull(),
            'position' => $this->integer()->null()->defaultValue(null),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-surveyId', '{{%survey_question}}', ['surveyId']);
        $this->createIndex('idx-surveyId-hidden', '{{%survey_question}}', ['surveyId', 'hidden']);
        $this->createIndex('idx-position', '{{%survey_question}}', ['position']);

        $this->addForeignKey('fk-survey', '{{%survey_question}}', 'surveyId', '{{%survey}}', 'id', 'CASCADE',
            'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-survey', '{{%survey_question}}');
        $this->dropTable('{{%survey_question}}');
    }
}

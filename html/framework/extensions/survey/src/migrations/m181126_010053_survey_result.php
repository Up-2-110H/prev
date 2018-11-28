<?php

use yii\db\Migration;

/**
 * Class m181126_010053_survey_result
 */
class m181126_010053_survey_result extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%survey_result}}', [
            'id' => $this->primaryKey(),
            'surveyId' => $this->integer()->notNull(),
            'questionId' => $this->integer()->notNull(),
            'answerId' => $this->integer()->null(),
            'value' => $this->text()->null(),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('idx-surveyId', '{{%survey_result}}', ['surveyId']);
        $this->createIndex('idx-questionId', '{{%survey_result}}', ['questionId']);
        $this->createIndex('idx-answerId', '{{%survey_result}}', ['answerId']);

        $this->addForeignKey('fk-survey-result', '{{%survey_result}}', 'surveyId', '{{%survey}}', 'id', 'CASCADE',
            'RESTRICT');
        $this->addForeignKey('fk-question-result', '{{%survey_result}}', 'questionId', '{{%survey_question}}', 'id',
            'CASCADE',
            'RESTRICT');
        $this->addForeignKey('fk-answer-result', '{{%survey_result}}', 'answerId', '{{%survey_answer}}', 'id',
            'CASCADE',
            'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-answer-result', '{{%survey_result}}');
        $this->dropForeignKey('fk-question-result', '{{%survey_result}}');
        $this->dropForeignKey('fk-survey-result', '{{%survey_result}}');

        $this->dropTable('{{%survey_result}}');
    }
}

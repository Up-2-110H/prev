<?php

use yii\db\Migration;

/**
 * Class m180906_063526_relation
 */
class m180906_063526_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%news_relation}}', [
            'id' => $this->primaryKey(),
            'newsId' => $this->integer(11)->notNull(),
            'groupId' => $this->integer(11)->notNull(),
        ], $options);

        $this->addForeignKey(
            'fk-newsId',
            '{{%news_relation}}',
            'newsId',
            '{{%news}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-groupId',
            '{{%news_relation}}',
            'groupId',
            '{{%news_group}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-groupId', '{{%news_relation}}');
        $this->dropForeignKey('fk-newsId', '{{%news_relation}}');

        $this->dropTable('{{%news_relation}}');
    }
}

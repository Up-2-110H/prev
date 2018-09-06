<?php

use yii\db\Migration;

/**
 * Class m180831_085513_directory
 */
class m180831_085513_directory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'directoryId', $this->integer()->null()->defaultValue(null)->after('[[id]]'));

        $this->addForeignKey('fk-news-directoryId', '{{%news}}', 'directoryId', '{{%directory}}', 'id',
            'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-news-directoryId', '{{%news}}');

        $this->dropColumn('{{%news}}', 'directoryId');
    }
}

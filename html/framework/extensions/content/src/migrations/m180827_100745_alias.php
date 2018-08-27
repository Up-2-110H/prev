<?php

use yii\db\Migration;

/**
 * Class m180827_100745_alias
 */
class m180827_100745_alias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%content}}', 'alias', $this->string(256));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%content}}', 'alias', $this->string(64));
    }
}

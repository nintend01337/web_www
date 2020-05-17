<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%link}}`.
 */
class m200517_161403_create_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%link}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'origin' => $this->string(),
            'short' =>$this->string(),
            'create_date' => $this->date(),
            'expire_date' => $this ->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%link}}');
    }
}

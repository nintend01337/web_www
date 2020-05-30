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
            'origin' => $this->string(1024),
            'short' =>$this->string(24),
            'create_date' => $this->string(),
            'expire_date' => $this ->string(),
            'count' =>$this ->integer()
        ]);
        $this->addForeignKey('user-id_user-id_link',
                            '{{%link}}','user_id',
                            '{{%user}}','id',
                            'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%link}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m180807_181128_alter_user_id
 */
class m180807_181128_alter_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('Recipe','author','integer');
        $this->createIndex('idx_author_id','Recipe','author');

        $this->addForeignKey(
            'fk_author',
            'Recipe',
            'author',
            'User',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180807_181128_alter_user_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180807_181128_alter_user_id cannot be reverted.\n";

        return false;
    }
    */
}

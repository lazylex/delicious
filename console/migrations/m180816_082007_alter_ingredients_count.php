<?php

use yii\db\Migration;

/**
 * Class m180816_082007_alter_ingredients_count
 */
class m180816_082007_alter_ingredients_count extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('Ingredients','count','DECIMAL(4, 1)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180816_082007_alter_ingredients_count cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180816_082007_alter_ingredients_count cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m180911_100905_alter_ingredients
 */
class m180911_100905_alter_ingredients extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_recipe_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180911_100905_alter_ingredients cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180911_100905_alter_ingredients cannot be reverted.\n";

        return false;
    }
    */
}

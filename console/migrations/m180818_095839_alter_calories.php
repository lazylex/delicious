<?php

use yii\db\Migration;

/**
 * Class m180818_095839_alter_calories
 */
class m180818_095839_alter_calories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('Ingredient','calories','DECIMAL(6, 2)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('Ingredient','calories','integer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180818_095839_alter_calories cannot be reverted.\n";

        return false;
    }
    */
}

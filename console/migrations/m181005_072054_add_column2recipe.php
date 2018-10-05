<?php

use yii\db\Migration;

/**
 * Class m181005_072054_add_column2recipe
 */
class m181005_072054_add_column2recipe extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('recipe', 'created', $this->dateTime());
        $this->addColumn('recipe', 'portions', $this->tinyInteger()->unsigned());
        $this->addColumn('recipe', 'calories_per_portion', 'DECIMAL(6, 2)');
        $this->addColumn('recipe', 'verified', $this->tinyInteger());
        $this->addColumn('recipe','full_time' , $this->time());//время, необходимое для полной готовности блюда
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('recipe', 'created');
        $this->dropColumn('recipe', 'portions');
        $this->dropColumn('recipe', 'calories_per_portion');
        $this->dropColumn('recipe', 'verified');
        $this->dropColumn('recipe', 'full_time');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181005_072054_add_column2recipe cannot be reverted.\n";

        return false;
    }
    */
}

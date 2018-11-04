<?php

use yii\db\Migration;

/**
 * Class m181104_170943_addRecipeImgUrl
 */
class m181104_170943_addRecipeImgUrl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('recipe', 'img_url', $this->char(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('recipe', 'img_url');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181104_170943_addRecipeImgUrl cannot be reverted.\n";

        return false;
    }
    */
}

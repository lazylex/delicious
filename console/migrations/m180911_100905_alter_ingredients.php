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
        $this->dropForeignKey(
            'fk_ingredient_id',
            'Ingredients'
        );

        $this->dropForeignKey(
            'fk_recipe_id',
            'Ingredients'
        );


        $this->dropTable("Ingredients");

        $this->createTable("Ingredients",
            [
                'recipe_id' => $this->smallInteger()->unsigned()->notNull(),
                'ingredient_id' => $this->smallInteger()->unsigned()->notNull(),
                'count' => $this->integer()->notNull()->defaultValue(1)->unsigned(),
                'PRIMARY KEY(recipe_id, ingredient_id)',
            ]);

        $this->alterColumn('Ingredients','count','DECIMAL(4, 1)');

        $this->addForeignKey(
            'fk_ingredient_id',
            'Ingredients',
            'ingredient_id',
            'Ingredient',
            'ingredient_id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_recipe_id',
            'Ingredients',
            'recipe_id',
            'Recipe',
            'recipe_id',
            'CASCADE',
            'CASCADE'
        );

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

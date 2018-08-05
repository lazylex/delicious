<?php

use yii\db\Migration;

/**
 * Class m180801_052555_create_db_structure
 */
class m180801_052555_create_db_structure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("Category",
            [
                'category_id' => $this->smallInteger()->unsigned()->notNull(),
                'parent_id' => $this->smallInteger()->unsigned(),//может ли быть NULL?
                'name' => $this->string(50)->notNull()->unique(),
                'url' => $this->string()->notNull(),
                'PRIMARY KEY(category_id)',
            ]);

        $this->createTable("Holidays",
            [
                'holiday_id' => $this->smallInteger()->unsigned()->notNull(),
                'date' => $this->date()->notNull(),
                'name' => $this->string(50)->notNull()->unique(),
                'PRIMARY KEY(holiday_id)',
            ]
        );

        $this->createTable("Unit",
            [
                'unit_id' => $this->smallInteger()->unsigned()->notNull(),
                'name' => $this->string(30)->notNull(),
                'PRIMARY KEY(unit_id)',
            ]);

        $this->createTable("Ingredient",
            [
                'ingredient_id' => $this->smallInteger()->unsigned()->notNull(),
                'name' => $this->string(30)->notNull(),
                'calories' => $this->integer(10),
                'unit_id' => $this->smallInteger()->unsigned()->notNull(),
                'PRIMARY KEY(ingredient_id)',
            ]);

        $this->createTable("Ingredients",
            [
                'recipe_id' => $this->smallInteger()->unsigned()->notNull(),
                'ingredient_id' => $this->smallInteger()->unsigned()->notNull(),
                'count' => $this->integer()->notNull()->defaultValue(1),
                'PRIMARY KEY(recipe_id, ingredient_id)',
            ]);

        $this->createTable("Recipe",
            [
                'recipe_id' => $this->smallInteger()->unsigned()->notNull(),
                'name' => $this->string(),
                'calories' => $this->integer(),
                'time' => $this->time(),
                'holiday_id' => $this->smallInteger()->unsigned(),
                'author' => $this->smallInteger()->unsigned(),
                'annotation' => $this->string(),
                'article' => $this->text()->notNull(),
                'category_id' => $this->smallInteger()->unsigned()->notNull(),
                'PRIMARY KEY(recipe_id)',
            ]);

        $this->createIndex('idx_unit_id','Ingredient','unit_id');
        $this->createIndex('idx_category_id','Recipe','category_id');
        $this->createIndex('idx_holiday_id','Recipe','holiday_id');

        $this->addForeignKey(
            'fk_unit_id',
            'Ingredient',
            'unit_id',
            'Unit',
            'unit_id',
            'CASCADE',
            'CASCADE'
        );

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

        $this->addForeignKey(
            'fk_holiday_id',
            'Recipe',
            'holiday_id',
            'Holidays',
            'holiday_id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_category_id',
            'Recipe',
            'category_id',
            'Category',
            'category_id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180801_052555_create_db_structure cannot be reverted.\n";
        $this->dropForeignKey(
            'fk_unit_id',
            'Ingredient'
        );

        $this->dropForeignKey(
            'fk_ingredient_id',
            'Ingredients'
        );

        $this->dropForeignKey(
            'fk_recipe_id',
            'Ingredients'
        );

        $this->dropForeignKey(
            'fk_holiday_id',
            'Recipe'
        );

        $this->dropForeignKey(
            'fk_category_id',
            'Recipe'
        );

        $this->dropIndex('idx_unit_id','Ingredient');
        $this->dropIndex('idx_category_id','Recipe');
        $this->dropIndex('idx_holiday_id','Recipe');

        $this->dropTable("Category");
        $this->dropTable("Holidays");
        $this->dropTable("Unit");
        $this->dropTable("Ingredient");
        $this->dropTable("Ingredients");
        $this->dropTable("Recipe");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180801_052555_create_db_structure cannot be reverted.\n";

        return false;
    }
    */
}

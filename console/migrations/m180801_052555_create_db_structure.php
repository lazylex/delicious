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
                'category_id' => $this->primaryKey(),
                'parent_id' => $this->integer(),
                'name' => $this->string(40)->notNull(),
                'url' => $this->string(50)->notNull(),
            ]);

        $this->createTable("Holidays",
            [
                'holiday_id' => $this->primaryKey(),
                'date' => $this->date()->notNull(),
                'name' => $this->string(50)->notNull(),
            ]
        );

        $this->createTable("Unit",
            [
                'unit_id' => $this->primaryKey(),
                'name' => $this->string(30)->notNull(),
            ]);

        $this->createTable("Ingridient",
            [
                'ingridient_id' => $this->primaryKey(),
                'name' => $this->string(30)->notNull(),
                'calories' => $this->integer(10),
                'unit_id' => $this->integer()->notNull()
            ]);

        //связываемые для внешних ключей поля должны быть ключами. Если это не так, нужно построить индекс

        $this->addForeignKey('unit_id', 'Ingridient', 'unit_id', 'Unit', 'unit_id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180801_052555_create_db_structure cannot be reverted.\n";

        return false;
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

<?php

use yii\db\Migration;

/**
 * Class m180819_102345_add_product_category
 */
class m180819_102345_add_product_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('Ingredient', 'product_category_id', $this->smallInteger()->unsigned());

        $this->createTable("ProductCategory",
            [
                'product_category_id' => $this->smallInteger()->unsigned()->notNull()->unique(),
                'name' => $this->string(50)->notNull()->unique(),
                'PRIMARY KEY(product_category_id)',
            ]);

        $this->alterColumn('{{%ProductCategory}}', 'product_category_id', $this->smallInteger()->unique()->unsigned() . ' NOT NULL AUTO_INCREMENT');

        $this->createIndex('idx_product_category_id','Ingredient','product_category_id');

        $this->addForeignKey(
            'fk_product_category_id',
            'Ingredient',
            'product_category_id',
            'ProductCategory',
            'product_category_id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_product_category_id','Ingredient');

        $this->dropIndex('idx_product_category_id','Ingredient');

        $this->dropTable("ProductCategory");

        $this->dropColumn('Ingredient','product_category_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180819_102345_add_product_category cannot be reverted.\n";

        return false;
    }
    */
}

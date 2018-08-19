<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "productcategory".
 *
 * @property int $product_category_id
 * @property string $name
 *
 * @property Ingredient[] $ingredients
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productcategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /*[['name'], 'required'],*/
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_category_id' => 'Первичный ключ',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['product_category_id' => 'product_category_id']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $recipe_id
 * @property int $ingredient_id
 * @property string $count
 *
 * @property Ingredient $ingredient
 * @property Recipe $recipe
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipe_id', 'ingredient_id'], 'required'],
            [['recipe_id', 'ingredient_id'], 'integer'],
            [['count'], 'number'],
           /* [['recipe_id'], 'unique'],*/
            [['recipe_id', 'ingredient_id'], 'unique', 'targetAttribute' => ['recipe_id', 'ingredient_id']],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingredient_id' => 'ingredient_id']],
            [['recipe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recipe::className(), 'targetAttribute' => ['recipe_id' => 'recipe_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Recipe ID',
            'ingredient_id' => 'Ingredient ID',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['ingredient_id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipe()
    {
        return $this->hasOne(Recipe::className(), ['recipe_id' => 'recipe_id']);
    }

    public static function primaryKey()
    {
        return ['recipe_id', 'ingredient_id'];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $ingredient_id
 * @property string $name
 * @property int $calories
 * @property int $unit_id
 *
 * @property Unit $unit
 * @property Ingredients[] $ingredients
 * @property Recipe[] $recipes
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'unit_id'], 'required'],
            [['unit_id'], 'integer'],
            [['calories'], 'number'],
            [['name'], 'string', 'max' => 30],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'unit_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ingredient_id' => 'Первичный ключ',
            'name' => 'Название',
            'calories' => 'Килокалорий',
            'unit_id' => 'Единица измерения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['unit_id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::className(), ['ingredient_id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes()
    {
        return $this->hasMany(Recipe::className(), ['recipe_id' => 'recipe_id'])->viaTable('ingredients', ['ingredient_id' => 'ingredient_id']);
    }
}

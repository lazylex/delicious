<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $unit_id
 * @property string $name
 *
 * @property Ingredient[] $ingredients
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required','message'=>'Введите название единицы измерения'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unit_id' => 'Первичный ключ',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['unit_id' => 'unit_id']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "holidays".
 *
 * @property int $holiday_id
 * @property string $date
 * @property string $name
 *
 * @property Recipe[] $recipes
 */
class Holidays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'holidays';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Это поле не может быть пустым. Введите название праздника.'],
            [['date'], 'required', 'message' => 'Выберите дату'],
            [['holiday_id'], 'integer', 'message' => 'Первичный ключ должен быть целочисленным'],
            [['date', 'holiday_id'], 'safe'],
            [['name'], 'string', 'max' => 50, 'tooLong' => 'Максимальная длина названия праздника - 50 символов'],
            [['name'], 'string', 'min' => 5, 'tooShort' => 'Минимальная длина названия праздника - 5 символов'],
            [['name'], 'unique', 'message' => 'Название праздника не должно повторяться в БД'],
            [['holiday_id'], 'unique', 'message' => 'Первичный ключ должен быть уникальным'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'holiday_id' => 'Первичный ключ',
            'date' => 'Дата',
            'name' => 'Название праздника',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes()
    {
        return $this->hasMany(Recipe::className(), ['holiday_id' => 'holiday_id']);
    }
}

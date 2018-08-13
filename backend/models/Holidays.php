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
            [['date', 'name'], 'required'],
            [['holiday_id'], 'integer'],
            [['date','holiday_id'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['holiday_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            /*'holiday_id' => 'Holiday ID',*/
            'date' => 'Date',
            'name' => 'Name',
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

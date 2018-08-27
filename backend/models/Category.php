<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $category_id
 * @property int $parent_id
 * @property string $name
 * @property string $url
 *
 * @property Recipe[] $recipes
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'url'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Первичный ключ',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'url' => 'URL',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipes()
    {
        return $this->hasMany(Recipe::className(), ['category_id' => 'category_id']);
    }

    public function getAllCategories()
    {
        return ArrayHelper::map(self::find()->all(), 'category_id', 'name');
    }
}

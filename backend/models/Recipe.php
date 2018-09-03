<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "recipe".
 *
 * @property int $recipe_id
 * @property string $name
 * @property int $calories
 * @property string $time
 * @property int $holiday_id
 * @property int $author
 * @property string $annotation
 * @property string $article
 * @property int $category_id
 *
 * @property Ingredients $ingredients
 * @property Ingredient[] $ingredients0
 * @property User $author0
 * @property Category $category
 * @property Holidays $holiday
 */
class Recipe extends \yii\db\ActiveRecord
{
    public $ing_post=[];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calories', 'holiday_id', 'author', 'category_id'], 'integer'],
            [['time'], 'safe'],
            [['article', 'category_id','name'], 'required'],
            [['article'], 'string'],
            [['name', 'annotation'], 'string', 'max' => 255],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['holiday_id'], 'exist', 'skipOnError' => true, 'targetClass' => Holidays::className(), 'targetAttribute' => ['holiday_id' => 'holiday_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Первичный ключ',
            'name' => 'Название',
            'calories' => 'Килокалорий',
            'time' => 'Время приготовления',
            'holiday_id' => 'Для какого праздника является традиционным блюдом',
            'author' => 'Автор',
            'annotation' => 'Краткое описание',
            'article' => 'Рецепт',
            'category_id' => 'Категория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasOne(Ingredients::className(), ['recipe_id' => 'recipe_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients0()
    {
        return $this->hasMany(Ingredient::className(), ['ingredient_id' => 'ingredient_id'])->viaTable('ingredients', ['recipe_id' => 'recipe_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoliday()
    {
        return $this->hasOne(Holidays::className(), ['holiday_id' => 'holiday_id']);
    }
}

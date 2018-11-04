<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "recipe".
 *
 * @property int $recipe_id
 * @property string $name
 * @property double $calories
 * @property double $calories_per_portion
 * @property string $time
 * @property int $holiday_id
 * @property int $author
 * @property int $portions
 * @property string $annotation
 * @property string $article
 * @property string $img_url
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

    public function beforeSave($insert)
    {
        $saveContinue = parent::beforeSave($insert);
        if (isset($this->portions) && isset($this->calories) && is_numeric($this->portions) && is_numeric($this->calories)) {
            $this->calories_per_portion = $this->calories / $this->portions;
        }
        return $saveContinue;
    }

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
            [['holiday_id', 'author', 'category_id'], 'integer'],
            [['portions'], 'integer', 'max' => 100, 'min' => 1],
            [['portions'], 'default', 'value' => 1],
            [['time', 'full_time'], 'safe'],
            [['article', 'category_id', 'name'], 'required'],
            [['article'], 'string'],
            [['calories', 'calories_per_portion'], 'number'],
            [['name', 'annotation', 'img_url'], 'string', 'max' => 255],
            [['verified'],'safe'],
            [['calories'], 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number', 'message' => 'Калорийность рецепта не может быть нулевой. Добавьте ингредиенты.'],
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
            'full_time' => 'Время до полной готовности блюда',
            'holiday_id' => 'Для какого праздника является традиционным блюдом',
            'author' => 'Автор',
            'annotation' => 'Краткое описание',
            'article' => 'Рецепт',
            'category_id' => 'Категория',
            'calories_per_portion' => 'Килокалорий в порции',
            'portions' => 'Порций',
            'img_url' => 'URL картинки',
            'verified'=>'Проверено, можно публиковать',
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

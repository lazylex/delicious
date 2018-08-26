<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Recipe;

/**
 * RecipeSearch represents the model behind the search form of `\backend\models\Recipe`.
 */
class RecipeSearch extends Recipe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipe_id', 'calories', 'holiday_id', 'author', 'category_id'], 'integer'],
            [['name', 'time', 'annotation', 'article'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Recipe::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'recipe_id' => $this->recipe_id,
            'calories' => $this->calories,
            'time' => $this->time,
            'holiday_id' => $this->holiday_id,
            'author' => $this->author,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'article', $this->article]);

        return $dataProvider;
    }
}

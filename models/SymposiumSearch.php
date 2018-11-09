<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Symposium;

/**
 * SymposiumSearch represents the model behind the search form about `app\models\Symposium`.
 */
class SymposiumSearch extends Symposium
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'what_day'], 'integer'],
            [['symposium_name', 'dates', 'times'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Symposium::find();

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
            'id' => $this->id,
            'dates' => $this->dates,
            'times' => $this->times,
            'what_day' => $this->what_day,
        ]);

        $query->andFilterWhere(['like', 'symposium_name', $this->symposium_name]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Representative;

/**
 * RepresentativeSearch represents the model behind the search form about `app\models\Representative`.
 */
class RepresentativeSearch extends Representative
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'room_type', 'attend', 'id_category_participant','user_id'], 'integer'],
            [['name', 'organization', 'position', 'assignment_letter', 'full_name'], 'safe'],
            [['speaker'], 'boolean'],
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
        $query = Representative::find();

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
            'title' => $this->title,
            'room_type' => $this->room_type,
            'attend' => $this->attend,
            'speaker' => $this->speaker,
            'id_category_participant' => $this->id_category_participant,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'assignment_letter', $this->assignment_letter])
            ->andFilterWhere(['like', 'full_name', $this->full_name]);

        return $dataProvider;
    }
}

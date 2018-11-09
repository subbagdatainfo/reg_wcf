<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Symposiumguestbook;

/**
 * SymposiumguestbookSearch represents the model behind the search form about `app\models\Symposiumguestbook`.
 */
class SymposiumguestbookSearch extends Symposiumguestbook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'participant_id', 'symposium_id'], 'integer'],
            [['date_entry'], 'safe'],
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
        $query = Symposiumguestbook::find();

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
            'participant_id' => $this->participant_id,
            'symposium_id' => $this->symposium_id,
            'date_entry' => $this->date_entry,
        ]);

        return $dataProvider;
    }
}

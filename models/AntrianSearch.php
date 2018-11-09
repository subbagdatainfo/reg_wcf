<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Antrian;

/**
 * AntrianSearch represents the model behind the search form about `app\models\Antrian`.
 */
class AntrianSearch extends Antrian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nomor_antrian_id', 'loket_id', 'user_id'], 'integer'],
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
        $query = Antrian::find();

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
            'nomor_antrian_id' => $this->nomor_antrian_id,
            'loket_id' => $this->loket_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}

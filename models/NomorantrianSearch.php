<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Nomorantrian;

/**
 * NomorantrianSearch represents the model behind the search form about `app\models\Nomorantrian`.
 */
class NomorantrianSearch extends Nomorantrian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nomor', 'status_antrian'], 'integer'],
            [['mulai_antri', 'selesai_antri'], 'safe'],
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
        $query = Nomorantrian::find();

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
            'nomor' => $this->nomor,
            'mulai_antri' => $this->mulai_antri,
            'selesai_antri' => $this->selesai_antri,
            'status_antrian' => $this->status_antrian,
        ]);

        return $dataProvider;
    }
}

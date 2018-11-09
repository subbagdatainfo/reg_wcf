<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registrasi;

/**
 * RegistrasiSearch represents the model behind the search form about `app\models\Registrasi`.
 */
class RegistrasiSearch extends Registrasi
{
    public $invitation_code;
    public $organization;
    public $variety;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id_participant','invitation_code','organization','variety'], 'string'],
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
        $query = Registrasi::find();

        // add conditions that should always apply here
        $query->joinWith('participant');
        $query->joinWith('participant.variety');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
        ]);

        $dataProvider->sort->attributes['invitation_code'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['participant.invitation_code' => SORT_ASC],
            'desc' => ['participant.invitation_code' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['organization'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['participant.organization' => SORT_ASC],
            'desc' => ['participant.organization' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['variety'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['participant.variety.variety' => SORT_ASC],
            'desc' => ['participant.variety.variety' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'id' => $this->id,
            //'id_participant' => $this->id_participant,
        ]);

        $query->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->id_participant)])
            ->andFilterWhere(['like', 'LOWER(participant.invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(participant.organization)', strtolower($this->organization)])
            ->andFilterWhere(['like', 'LOWER(participant.variety.variety)', strtolower($this->variety)]);

        return $dataProvider;
    }
}

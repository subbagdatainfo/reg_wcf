<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Varietypartisipant;

/**
 * VarietypartisipantSearch represents the model behind the search form about `app\models\Varietypartisipant`.
 */
class VarietypartisipantSearch extends Varietypartisipant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quota'], 'integer'],
            [['variety', 'format_invitation_code', 'facility', 'attendance','group_participant_id'], 'safe'],
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

        $role_user = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        
        // variable = ["key" => "value"]
        // variable = "key"

        foreach ($role_user as $key => $value) {
                $role_user = $key;
        }

        if ($role_user == 'rolesuper') {
            $query = Varietypartisipant::find()->orderBy(['variety' => SORT_ASC]);
        }elseif ($role_user == 'roleadmin') {
            $query = Varietypartisipant::find()->orderBy(['variety' => SORT_ASC]);
        }elseif ($role_user == 'rolewdb') {
            $query = Varietypartisipant::find()->where(['group_participant_id' => 1])->orderBy(['variety' => SORT_ASC]);
            // $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->where(['group_participant_id' => 1])->all(), 'id', 'variety');
        }elseif ($role_user == 'rolelocal') {
            $query = Varietypartisipant::find()->where(['group_participant_id' => [2,4]])->orderBy(['variety' => SORT_ASC]);
            // $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->where(['group_participant_id' => [2,4]])->all(), 'id', 'variety');
        }elseif ($role_user == 'roleinternational') {
            $query = Varietypartisipant::find()->where(['group_participant_id' =>  [3,4]])->orderBy(['variety' => SORT_ASC]);
            // $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->where(['group_participant_id' => [3,4]])->all(), 'id', 'variety');
        }
      

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
            'quota' => $this->quota,
        ]);

        $query->andFilterWhere(['like', 'variety', $this->variety])
            ->andFilterWhere(['like', 'format_invitation_code', $this->format_invitation_code])
            ->andFilterWhere(['like', 'facility', $this->facility])
            ->andFilterWhere(['like', 'attendance', $this->attendance])
            ->andFilterWhere(['like', 'group_participant_id', $this->group_participant_id]);

        return $dataProvider;
    }
}

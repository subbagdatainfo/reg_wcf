<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Companion;

/**
 * CompanionSearch represents the model behind the search form about `app\models\Participant`.
 */
class CompanionSearch extends Companion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'token', 'country_id', 'nationality', 'participant_status', 'variety_id', 'dietary_id', 'symposium_day_one_id', 'symposium_day_two_id', 'attend_id', 'provinsi_id', 'user_id', 'room_type_id', 'is_companion_from'], 'integer'],
            [['invitation_code', 'title', 'full_name', 'user_photo', 'name_on_badge', 'address', 'gender', 'date_of_birth', 'pasport_ktp_number', 'place_of_issue', 'start_date', 'end_date', 'phone', 'fax', 'email', 'category', 'organization', 'abstract', 'file_presentation', 'full_paper', 'photo', 'date_arrival', 'time_arrival', 'flight_number_arrival', 'eta', 'date_departure', 'time_departure', 'flight_number_departure', 'etd', 'start_date_attend', 'end_date_attend', 'handphone', 'tell_us', 'candidate_chosen', 'essay', 'tittle', 'author', 'content', 'transportation', 'ktp_pasport', 'dietary_specify'], 'safe'],
            [['partisipant', 'speaker', 'visit_subak_bali', 'cultural_visit', 'is_delete', 'invitation_sent', 'room_type_approve', 'submit', 'is_representative', 'is_companion', 'is_companion_valid'], 'boolean'],
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
    public function searchParticipant($params)
    {
        $participant_model  = Participant::find()->where(["user_id"=>Yii::$app->user->identity->id])->one();
        $query = Companion::find()->where(["is_companion_from"=>$participant_model->id]);

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
            'token' => $this->token,
            'country_id' => $this->country_id,
            'nationality' => $this->nationality,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'partisipant' => $this->partisipant,
            'speaker' => $this->speaker,
            'participant_status' => $this->participant_status,
            'variety_id' => $this->variety_id,
            'dietary_id' => $this->dietary_id,
            'symposium_day_one_id' => $this->symposium_day_one_id,
            'symposium_day_two_id' => $this->symposium_day_two_id,
            'date_arrival' => $this->date_arrival,
            'time_arrival' => $this->time_arrival,
            'date_departure' => $this->date_departure,
            'time_departure' => $this->time_departure,
            'start_date_attend' => $this->start_date_attend,
            'end_date_attend' => $this->end_date_attend,
            'visit_subak_bali' => $this->visit_subak_bali,
            'cultural_visit' => $this->cultural_visit,
            'attend_id' => $this->attend_id,
            'is_delete' => $this->is_delete,
            'invitation_sent' => $this->invitation_sent,
            'provinsi_id' => $this->provinsi_id,
            'user_id' => $this->user_id,
            'room_type_id' => $this->room_type_id,
            'room_type_approve' => $this->room_type_approve,
            'submit' => $this->submit,
            'is_representative' => $this->is_representative,
            'is_companion' => $this->is_companion,
            'is_companion_valid' => $this->is_companion_valid,
            'is_companion_from' => $this->is_companion_from,
        ]);

        $query->andFilterWhere(['like', 'invitation_code', $this->invitation_code])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'pasport_ktp_number', $this->pasport_ktp_number])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'file_presentation', $this->file_presentation])
            ->andFilterWhere(['like', 'full_paper', $this->full_paper])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'flight_number_arrival', $this->flight_number_arrival])
            ->andFilterWhere(['like', 'eta', $this->eta])
            ->andFilterWhere(['like', 'flight_number_departure', $this->flight_number_departure])
            ->andFilterWhere(['like', 'etd', $this->etd])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'tell_us', $this->tell_us])
            ->andFilterWhere(['like', 'candidate_chosen', $this->candidate_chosen])
            ->andFilterWhere(['like', 'essay', $this->essay])
            ->andFilterWhere(['like', 'tittle', $this->tittle])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'transportation', $this->transportation])
            ->andFilterWhere(['like', 'ktp_pasport', $this->ktp_pasport])
            ->andFilterWhere(['like', 'dietary_specify', $this->dietary_specify]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchValidation($params)
    {
        $id_have_companion  = Companion::find()->select('is_companion_from')->where(['not', ['is_companion_from' => null]])->AsArray()->column();
        $query              = Companion::find()->where(["id"=> $id_have_companion]);

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
            'token' => $this->token,
            'country_id' => $this->country_id,
            'nationality' => $this->nationality,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'partisipant' => $this->partisipant,
            'speaker' => $this->speaker,
            'participant_status' => $this->participant_status,
            'variety_id' => $this->variety_id,
            'dietary_id' => $this->dietary_id,
            'symposium_day_one_id' => $this->symposium_day_one_id,
            'symposium_day_two_id' => $this->symposium_day_two_id,
            'date_arrival' => $this->date_arrival,
            'time_arrival' => $this->time_arrival,
            'date_departure' => $this->date_departure,
            'time_departure' => $this->time_departure,
            'start_date_attend' => $this->start_date_attend,
            'end_date_attend' => $this->end_date_attend,
            'visit_subak_bali' => $this->visit_subak_bali,
            'cultural_visit' => $this->cultural_visit,
            'attend_id' => $this->attend_id,
            'is_delete' => $this->is_delete,
            'invitation_sent' => $this->invitation_sent,
            'provinsi_id' => $this->provinsi_id,
            'user_id' => $this->user_id,
            'room_type_id' => $this->room_type_id,
            'room_type_approve' => $this->room_type_approve,
            'submit' => $this->submit,
            'is_representative' => $this->is_representative,
            'is_companion' => $this->is_companion,
            'is_companion_valid' => $this->is_companion_valid,
            'is_companion_from' => $this->is_companion_from,
        ]);

        $query->andFilterWhere(['like', 'invitation_code', $this->invitation_code])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'pasport_ktp_number', $this->pasport_ktp_number])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'file_presentation', $this->file_presentation])
            ->andFilterWhere(['like', 'full_paper', $this->full_paper])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'flight_number_arrival', $this->flight_number_arrival])
            ->andFilterWhere(['like', 'eta', $this->eta])
            ->andFilterWhere(['like', 'flight_number_departure', $this->flight_number_departure])
            ->andFilterWhere(['like', 'etd', $this->etd])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'tell_us', $this->tell_us])
            ->andFilterWhere(['like', 'candidate_chosen', $this->candidate_chosen])
            ->andFilterWhere(['like', 'essay', $this->essay])
            ->andFilterWhere(['like', 'tittle', $this->tittle])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'transportation', $this->transportation])
            ->andFilterWhere(['like', 'ktp_pasport', $this->ktp_pasport])
            ->andFilterWhere(['like', 'dietary_specify', $this->dietary_specify]);

        return $dataProvider;
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
        $query = Companion::find();

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
            'token' => $this->token,
            'country_id' => $this->country_id,
            'nationality' => $this->nationality,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'partisipant' => $this->partisipant,
            'speaker' => $this->speaker,
            'participant_status' => $this->participant_status,
            'variety_id' => $this->variety_id,
            'dietary_id' => $this->dietary_id,
            'symposium_day_one_id' => $this->symposium_day_one_id,
            'symposium_day_two_id' => $this->symposium_day_two_id,
            'date_arrival' => $this->date_arrival,
            'time_arrival' => $this->time_arrival,
            'date_departure' => $this->date_departure,
            'time_departure' => $this->time_departure,
            'start_date_attend' => $this->start_date_attend,
            'end_date_attend' => $this->end_date_attend,
            'visit_subak_bali' => $this->visit_subak_bali,
            'cultural_visit' => $this->cultural_visit,
            'attend_id' => $this->attend_id,
            'is_delete' => $this->is_delete,
            'invitation_sent' => $this->invitation_sent,
            'provinsi_id' => $this->provinsi_id,
            'user_id' => $this->user_id,
            'room_type_id' => $this->room_type_id,
            'room_type_approve' => $this->room_type_approve,
            'submit' => $this->submit,
            'is_representative' => $this->is_representative,
            'is_companion' => $this->is_companion,
            'is_companion_valid' => $this->is_companion_valid,
            'is_companion_from' => $this->is_companion_from,
        ]);

        $query->andFilterWhere(['like', 'invitation_code', $this->invitation_code])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'pasport_ktp_number', $this->pasport_ktp_number])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'file_presentation', $this->file_presentation])
            ->andFilterWhere(['like', 'full_paper', $this->full_paper])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'flight_number_arrival', $this->flight_number_arrival])
            ->andFilterWhere(['like', 'eta', $this->eta])
            ->andFilterWhere(['like', 'flight_number_departure', $this->flight_number_departure])
            ->andFilterWhere(['like', 'etd', $this->etd])
            ->andFilterWhere(['like', 'handphone', $this->handphone])
            ->andFilterWhere(['like', 'tell_us', $this->tell_us])
            ->andFilterWhere(['like', 'candidate_chosen', $this->candidate_chosen])
            ->andFilterWhere(['like', 'essay', $this->essay])
            ->andFilterWhere(['like', 'tittle', $this->tittle])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'transportation', $this->transportation])
            ->andFilterWhere(['like', 'ktp_pasport', $this->ktp_pasport])
            ->andFilterWhere(['like', 'dietary_specify', $this->dietary_specify]);

        return $dataProvider;
    }
}

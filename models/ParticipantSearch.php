<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Participant;
use app\models\Varietypartisipant;

/**
 * ParticipantSearch represents the model behind the search form about `app\models\Participant`.
 */
class ParticipantSearch extends Participant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'token', 'country_id', 'pasport_ktp_number', 'phone', 'fax', 'participant_status', 'variety_id', 'dietary_id', 'symposium_day_one_id', 'symposium_day_two_id','attend_id'], 'integer'],
            [['invitation_code', 'title', 'full_name', 'user_photo', 'name_on_badge', 'address', 'gender', 'date_of_birth', 'nationality', 'place_of_issue', 'start_date', 'end_date', 'email', 'category', 'organization', 'abstract', 'file_presentation', 'full_paper', 'photo', 'date_arrival', 'time_arrival', 'flight_number_arrival', 'eta', 'date_departure', 'time_departure', 'flight_number_departure', 'etd', 'start_date_attend', 'end_date_attend','user_id'], 'safe'],
            [['partisipant', 'speaker', 'visit_subak_bali', 'cultural_visit', 'is_delete','status_subsidi','submit'], 'boolean'],
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
    
    //============================================== WDB ==============================================

    public function searchSymposiumparticipant($params)
    {
        $query = Participant::find()->where(['not', ['symposium_day_one_id' => null]])->where(['not', ['symposium_day_two_id' => null]])->andWhere(['participant_status' => [1,2]]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(user.email)', strtolower($this->user_id)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'LOWER(nation.country_name)', strtolower($this->nationality)])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchSpeaker($params)
    {
        $query = Participant::find()->where(['variety_id' => [1,2]]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(user.email)', strtolower($this->user_id)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'LOWER(nation.country_name)', strtolower($this->nationality)])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchSymposium($params)
    {
        $query = Participant::find()->where(['variety_id' => [3,4,5,8]]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    public function searchIyf($params)
    {
        $query = Participant::find()->where(['variety_id' => [6,7,9]]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    //=========================================== END WDB ===========================================



    //=============================================== LOCAL PARTICIPANT =================================


    public function searchInvited($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>2])->OrderBy('id')->AsArray()->Column();
        $query      = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'LOWER(name_on_badge)', strtolower($this->name_on_badge)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchPublic($params)
    {
        $query = Participant::find()->where(['variety_id' => [35],'participant_status'=>2])/*->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC')->limit(100)*/;

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'submit' => $this->submit,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchPublicModal($params)
    {
        $query = Participant::find()->where(['variety_id' => [35]])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC')->limit(100);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchInternationalModal($params)
    {
        $query = Participant::find()->where(['variety_id' => [19]])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC')->limit(100);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchPublicselection($params)
    {
        $query = Participant::find()->where(['variety_id' => [35]])->OrderBy('full_name ASC');

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    //============================================== END LOCAL PARTICIPANT ===========================




    //=========================================== INTERNATIONAL PARTICIPANT ============================
    
    public function searchInternationalinvited($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>3])->OrderBy('id')->AsArray()->Column();
        $query = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'LOWER(name_on_badge)', strtolower($this->name_on_badge)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    public function searchInternationalpublic($params)
    {
        $query = Participant::find()->where(['variety_id' => [19],'participant_status'=>2])/*->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC')->limit(100)*/;

        // add conditions that should always apply here

        $query->joinWith(['users']);
        $query->joinWith(['country']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'submit' => $this->submit
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'LOWER(name_on_badge)', strtolower($this->name_on_badge)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'LOWER(country.country_name)', strtolower($this->nationality)])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }
    //===========================================END INTERNATIONAL PARTICIPANT =========================

    public function searchInternationalpublicselection($params)
    {
        $query = Participant::find()->where(['variety_id' => [19]])->OrderBy('full_name');

        // add conditions that should always apply here

        $query->joinWith(['users']);
        $query->joinWith(['country']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'LOWER(country.country_name)', strtolower($this->nationality)])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    //======================================================== EXPORT MODEL ===========================================


    public function searchExportwdb($params)
    {
        $query = Participant::find()->where(['variety_id' => [1,2,3,4,5,6,7,8,9]]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'invitation_code', $this->invitation_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    public function searchExportlocal($params)
    {
        $query = Participant::find()->where(['variety_id' => [20,21,22,23,24,25,26,27,28,29,30,31,33,32,34,35]]);

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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'invitation_code', $this->invitation_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


     public function searchExportinternational($params)
    {
        $query = Participant::find()->where(['variety_id' => [10,11,12,13,14,15,16,17,18,19]]);

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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'invitation_code', $this->invitation_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }



    //======================================================== END EXPORT MODEL ===========================================


    public function search($params)
    {
        $query = Participant::find()->where(["participant_status"=>[1,2]])->orderBy(['full_name' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                    'pageSize'  => 6
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'LOWER(name_on_badge)', strtolower($this->name_on_badge)])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }



    // ================================================================ HASIL LOCAL===================================================

            public function searchPublicselectionhasil($params)
    {
        $query = Participant::find()->where(['variety_id' => [35]])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC');

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'LOWER(name_on_badge)', strtolower($this->name_on_badge)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }



    // ============================================================ END HASIL LOCAL ==================================================




    // =========================================================== HASIL INTERNATIONAL ===============================================



    public function searchInternationalselectionhasil($params)
    {
        $query = Participant::find()->where(['variety_id' => [19]])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC');

        // add conditions that should always apply here

        $query->joinWith(['users']);
        $query->joinWith(['country']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'LOWER(country.country_name)', strtolower($this->nationality)])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }



    //SEARCH UNTUK ADMINISTRASI


    public function searchAdministrasi($params)
    {
        // public participant public yang lolos belum dimasukan kedalam full_subsidi untuk vaiety_id = 19 dan 35
        $query = Participant::find()->where(['variety_id' => [6,2,3,4,5,13,14,20,21,24,1,30,32,25,40,31,34,9,17,23,33]])->orderBy('variety_id DESC' );

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>

                [
                    'pageSize'  => 10,
                ],
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi' => $this->status_subsidi,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }






    // ========================================================== END HASIL INTERNATIONAL ============================================




    //======================================EXPORT INTERNATIONAL PUBLIC UNTUK ADMINISTRASI ============================================

        public function searchAdministrasiExportInternational($params)
        {
            $query = Participant::find()->where(['variety_id' => 19,'participant_status'  => 2])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC')->limit(100);

            // add conditions that should always apply here
            $query->joinWith(['users']);
            $dataProvider = new ActiveDataProvider([
                'query'         => $query,
                'pagination'    => false,
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
                'pasport_ktp_number' => $this->pasport_ktp_number,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'phone' => $this->phone,
                'fax' => $this->fax,
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
                'is_delete' => $this->is_delete,
                'status_subsidi'    => $this->status_subsidi
            ]);

            $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
                ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
                ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
                ->andFilterWhere(['like', 'user.email', $this->user_id])
                ->andFilterWhere(['like', 'user_photo', $this->user_photo])
                ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
                ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
                ->andFilterWhere(['like', 'gender', $this->gender])
                ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
                ->andFilterWhere(['like', 'nationality', $this->nationality])
                ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
                ->andFilterWhere(['like', 'etd', $this->etd]);

            return $dataProvider;
        }


        //=========================================== INTERNATIONAL PARTICIPANT ============================
    
    public function searchAdministrasiInternationalinvited($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>3])->OrderBy('id')->AsArray()->Column();
        $query = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi' => $this->status_subsidi,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    //===================================== END EXPORT INTERNATIONAL UNTUK ADMINISTRASI =======================================



    //======================================EXPORT LOCAL PUBLIC UNTUK ADMINISTRASI ============================================


    public function searchAdministrasiLocalInvited($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=> [2,3]])->OrderBy('id')->AsArray()->Column();
        $query      = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi' => $this->status_subsidi,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchAdministrasiExportLocal($params)
    {
        $query = Participant::find()->where(['variety_id' => 35,'participant_status'  => 2])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC')->limit(100);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchGhani($params)
    {
        $query = Participant::find()->where(['variety_id' => 46]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    public function searchDyandra($params)
    {
        $query = Participant::find()->where(['variety_id' => 47]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchKemdikbud($params)
    {
        $query = Participant::find()->where(['variety_id' => 48]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchTechnicalsupport($params)
    {
        $query = Participant::find()->where(['variety_id' => 49]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchPersidangan($params)
    {
        $query = Participant::find()->where(['variety_id' => 53]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchPengarah($params)
    {
        $query = Participant::find()->where(['variety_id' => 52]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchFidaf($params)
    {
        $query = Participant::find()->where(['variety_id' => 51]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchProtokol($params)
    {
        $query = Participant::find()->where(['variety_id' => 50]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => false,
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }




    public function searchMedia($params)
    {
        $query = Participant::find()->where(['variety_id' => 34]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchMedical($params)
    {
        $query = Participant::find()->where(['variety_id' => 57]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchExhibition($params)
    {
        $query = Participant::find()->where(['variety_id' => 58]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    public function searchIyfporudction($params)
    {
        $query = Participant::find()->where(['variety_id' => 59]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchLiaisonofficer($params)
    {
        $query = Participant::find()->where(['variety_id' => 56]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchCommittie($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>4])->OrderBy('id')->AsArray()->Column();
        $query = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => [
                'pageSize'  => 10,
            ]
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
            'status_subsidi'    => $this->status_subsidi
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user.email', $this->user_id])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'LOWER(address)', strtolower($this->address)])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }

    public function searchRecapitulation($params)
    {
        $query = Participant::find()->where(['not', ['symposium_day_one_id' => null]])->where(['not', ['symposium_day_two_id' => null]])->andWhere(['participant_status' => [1,2]]);

        // add conditions that should always apply here
        $query->joinWith(['users']);
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
            'pasport_ktp_number' => $this->pasport_ktp_number,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'phone' => $this->phone,
            'fax' => $this->fax,
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
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'LOWER(invitation_code)', strtolower($this->invitation_code)])
            ->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)])
            ->andFilterWhere(['like', 'LOWER(user.email)', strtolower($this->user_id)])
            ->andFilterWhere(['like', 'LOWER(full_name)', strtolower($this->full_name)])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo])
            ->andFilterWhere(['like', 'name_on_badge', $this->name_on_badge])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'LOWER(nation.country_name)', strtolower($this->nationality)])
            ->andFilterWhere(['like', 'place_of_issue', $this->place_of_issue])
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
            ->andFilterWhere(['like', 'etd', $this->etd]);

        return $dataProvider;
    }


    //===================================== END EXPORT LOCAL PUBLIC UNTUK ADMINISTRASI =======================================
}

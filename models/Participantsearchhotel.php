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
class ParticipantSearchhotel extends Participant
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
            [['hotel_id'],'string'],
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
    

    //--------------------------------LOCAL PUBLIC PARTICIPANT---------------------------------------------------
    public function searchHotelPublicParticipantLocal($params)
    {
        $query = Participant::find()->where(['variety_id' => 35,'participant_status' => 2])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC');

        // add conditions that should always apply here
        $query->joinWith(['users','hotel']);
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
            ->andFilterWhere(['like', 'LOWER(hotel_name)', strtolower($this->hotel_id)])
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


    //---------------------- PUBLIC INTERNATIONAL PARTICIPANT------------------------------------
    public function searchHotelPublicParticipantInternational($params)
    {
        $query = Participant::find()->where(['variety_id' => 19,'participant_status' => 2])->OrderBy('(nilai_ps + nilai_mo + nilai_eo + nilai_ek + nilai_eb + nilai_rl + nilai_cv) DESC');

        // add conditions that should always apply here
        $query->joinWith(['users','hotel']);
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
            ->andFilterWhere(['like', 'LOWER(hotel_name)', strtolower($this->hotel_id)])
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


    //------------------------INVITED LOCAL PARTICIPANT --------------------------------------------------
    public function searchInvitedLocal($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>2])->OrderBy('id')->AsArray()->Column();
        $query      = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users','hotel']);
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
            ->andFilterWhere(['like', 'LOWER(hotel_name)', strtolower($this->hotel_id)])
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

    //------------------------INVITED INTERNATIONAL PARTICIPANT --------------------------------------------------
    public function searchInvitedInternational($params)
    {
        $array_id   = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>3])->OrderBy('id')->AsArray()->Column();
        $query      = Participant::find()->where(['variety_id' => $array_id]);

        // add conditions that should always apply here
        $query->joinWith(['users','hotel']);
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
            ->andFilterWhere(['like', 'LOWER(hotel_name)', strtolower($this->hotel_id)])
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
    
}

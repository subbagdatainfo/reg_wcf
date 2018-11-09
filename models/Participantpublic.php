<?php

namespace app\models;

use Yii;
use thyseus\validators\WordValidator;

/**
 * This is the model class for table "participant".
 *
 * @property integer $id
 * @property string $invitation_code
 * @property integer $token
 * @property string $title
 * @property string $full_name
 * @property string $user_photo
 * @property string $name_on_badge
 * @property string $address
 * @property string $gender
 * @property string $date_of_birth
 * @property integer $country_id
 * @property string $nationality
 * @property integer $pasport_ktp_number
 * @property string $place_of_issue
 * @property string $start_date
 * @property string $end_date
 * @property integer $phone
 * @property integer $fax
 * @property string $email
 * @property boolean $partisipant
 * @property string $category
 * @property string $organization
 * @property boolean $speaker
 * @property string $abstract
 * @property string $file_prensentation
 * @property string $full_paper
 * @property string $photo
 * @property integer $participant_status
 * @property integer $variety_id
 * @property integer $dietary_id
 * @property integer $symposium_day_one_id
 * @property integer $symposium_day_two_id
 * @property string $date_arrival
 * @property string $time_arrival
 * @property string $flight_number_arrival
 * @property string $eta
 * @property string $date_departure
 * @property string $time_departure
 * @property string $flight_number_departure
 * @property string $etd
 * @property string $start_date_attend
 * @property string $end_date_attend
 * @property boolean $visit_subak_bali
 * @property boolean $cultural_visit
 *
 * @property Country $country
 * @property DietaryPreferences $dietary
 * @property Symposium $symposiumDayOne
 * @property Symposium $symposiumDayTwo
 * @property VarietyPartisipant $variety
 */
class Participantpublic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participant';
    }

    public $file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'country_id', 'phone','handphone', 'fax', 'participant_status', 'variety_id', 'dietary_id', 'symposium_day_one_id', 'symposium_day_two_id', 'attend_id','room_type_id'], 'integer'],
            [['title', 'full_name', 'name_on_badge', 'address', 'gender', 'date_of_birth', 'nationality', 'place_of_issue', 'email', 'category', 'organization', 'abstract','tell_us','candidate_chosen','tittle','author','content','pasport_ktp_number'], 'string'],
            [['title','full_name', 'name_on_badge','gender','date_of_birth','nationality','phone','handphone','tell_us','candidate_chosen'], 'required'],
            [['start_date', 'end_date', 'date_arrival', 'time_arrival', 'date_departure', 'time_departure', 'start_date_attend', 'end_date_attend'], 'safe'],
            [['partisipant', 'speaker', 'visit_subak_bali', 'cultural_visit', 'is_delete','room_type_approve','submit'], 'boolean'],
            [['invitation_code'], 'string', 'max' => 10],
            // [['tell_us'],'string','max' => 255],
            // [['tell_us','candidate_chosen'], WordValidator::className(), 'min' => 10, 'max' => 250, 'messages'  => ['max' => '{attribute} is too long (maximum is {max} words, but now it\'s {length})']],
            [['tell_us'], WordValidator::className(),
                'min' => 0,
                'max' => 250,
                'whitelist' =>  NULL,
                'blacklist' => NULL,
                'messages'  => [
                    'max'       => 'Motivation is too long (maximum is {max} words, but now it\'s {length})'
                ]
            ], 
            [['candidate_chosen'], WordValidator::className(),
                'min' => 0,
                'max' => 250,
                'whitelist' => NULL,
                'blacklist' => NULL,
                'messages'  => [
                    'max' => 'Personal Statement is too long (maximum is {max} words, but now it\'s {length})'
                ]
            ],
            [['essay'], 'file', 'extensions' => 'pdf, docx, doc'],
            [['essay'],'required','on'=>'tidak_ada_essay'],
            // [['essay'],'required','on'=>'create'],
            // [['user_photo'],'required','on'=>'create','message' => 'Photo Cannot be blank'],
            [['user_photo'], 'file', 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invitation_code' => 'Invitation Code',
            'token' => 'Token',
            'title' => 'Title',
            'full_name' => 'Full Name',
            'user_photo' => 'User Photo',
            'name_on_badge' => 'Name On Badge',
            'address' => 'Address',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'country_id' => 'Country ID',
            'nationality' => 'Nationality',
            'pasport_ktp_number' => 'Pasport Ktp Number',
            'place_of_issue' => 'Place Of Issue',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'email' => 'Email',
            'partisipant' => 'Partisipant',
            'category' => 'Category',
            'organization' => 'Organization',
            'speaker' => 'Speaker',
            'abstract' => 'Abstract',
            'file_presentation' => 'File Prensentation',
            'essay' => 'Essay',
            'full_paper' => 'Full Paper',
            'photo' => 'Photo',
            'participant_status' => 'Participant Status',
            'variety_id' => 'Variety ID',
            'dietary_id' => 'Dietary ID',
            'symposium_day_one_id' => 'Symposium Day One ID',
            'symposium_day_two_id' => 'Symposium Day Two ID',
            'date_arrival' => 'Date Arrival',
            'time_arrival' => 'Time Arrival',
            'flight_number_arrival' => 'Flight Number Arrival',
            'eta' => 'Eta',
            'date_departure' => 'Date Departure',
            'time_departure' => 'Time Departure',
            'flight_number_departure' => 'Flight Number Departure',
            'etd' => 'Etd',
            'start_date_attend' => 'Start Date Attend',
            'end_date_attend' => 'End Date Attend',
            'visit_subak_bali' => 'Visit Subak Bali',
            'cultural_visit' => 'Cultural Visit',
            'attend_id' => 'Attend',
            'is_delete' => 'Deleted',
            'room_type_id' => 'Room Type',
            'room_type_approve' => 'Confirmation for Room Type',
            'submit' => 'Submit',
            'tell_us' => 'Motivation',
            'candidate_chosen' => 'Personal Statement'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDietary()
    {
        return $this->hasOne(DietaryPreferences::className(), ['id' => 'dietary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSymposiumDayOne()
    {
        return $this->hasOne(Symposium::className(), ['id' => 'symposium_day_one_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSymposiumDayTwo()
    {
        return $this->hasOne(Symposium::className(), ['id' => 'symposium_day_two_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariety()
    {
        return $this->hasOne(Varietypartisipant::className(), ['id' => 'variety_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttend()
    {
        return $this->hasOne(Attend::className(), ['id' => 'attend_id']);
    }

    public function getRoom()
    {
        return $this->hasOne(RoomType::className(), ['id' => 'room_type_id']);
    }
}

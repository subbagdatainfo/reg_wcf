<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "representative".
 *
 * @property integer $id
 * @property string $name
 * @property string $organization
 * @property string $position
 * @property string $assignment_letter
 * @property integer $title
 * @property string $full_name
 * @property integer $room_type
 * @property integer $attend
 * @property boolean $speaker
 * @property integer $id_category_participant
 */
class Representative extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'representative';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'organization', 'position', 'assignment_letter', 'full_name'], 'string'],
            [['title', 'room_type', 'attend', 'id_category_participant','user_id'], 'integer'],
            [['name', 'organization', 'position', 'assignment_letter'], 'required'],
            [['speaker','approval'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Full Name of Representative',
            'organization' => 'Organization',
            'position' => 'Position',
            'assignment_letter' => 'Assignment Letter',
            'title' => 'Title',
            'full_name' => 'Full Name Invited',
            'room_type' => 'Room Type',
            'attend' => 'Attend',
            'speaker' => 'Speaker',
            'id_category_participant' => 'Id Category Participant',
            'user_id' => 'User',
            'approval' => 'Approval'
        ];
    }

    public function getRoom()
    {
        return $this->hasOne(RoomType::className(), ['id' => 'room_type']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAttending()
    {
        return $this->hasOne(Attend::className(), ['id' => 'attend']);
    }

    public function getVarietyparticipant()
    {
        return $this->hasOne(Varietypartisipant::className(), ['id' => 'id_category_participant']);
    }
}

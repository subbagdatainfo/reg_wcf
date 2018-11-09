<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variety_partisipant".
 *
 * @property integer $id
 * @property string $variety
 * @property string $format_invitation_code
 * @property integer $quota
 * @property string $facility
 * @property string $attendance
 *
 * @property Participant[] $participants
 */
class Varietypartisipant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'variety_partisipant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variety', 'facility'], 'string'],
            [['quota','group_participant_id'], 'integer'],
            [['format_invitation_code'], 'string', 'max' => 6],
            [['attendance'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                        => 'ID',
            'variety'                   => 'Variety',
            'format_invitation_code'    => 'Format Invitation Code',
            'quota'                     => 'Quota',
            'facility'                  => 'Facility',
            'attendance'                => 'Attendance',
            'group_participant_id'      => 'Group Variety'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipants()
    {
        return $this->hasMany(Participant::className(), ['variety_id' => 'id']);
    }
    public function getGroup()
    {
        return $this->hasOne(Groupvarietyparticipant::className(), ['id' => 'group_participant_id']);
    }
}

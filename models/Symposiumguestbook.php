<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "symposium_guest_book".
 *
 * @property integer $id
 * @property integer $participant_id
 * @property integer $symposium_id
 * @property string $date_entry
 *
 * @property Participant $participant
 * @property Symposium $symposium
 */
class Symposiumguestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'symposium_guest_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['participant_id', 'symposium_id'], 'integer'],
            [['date_entry'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'participant_id' => 'Participant ID',
            'symposium_id' => 'Symposium ID',
            'date_entry' => 'Date Entry',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipant()
    {
        return $this->hasOne(Participant::className(), ['id' => 'participant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSymposium()
    {
        return $this->hasOne(Symposium::className(), ['id' => 'symposium_id']);
    }
}

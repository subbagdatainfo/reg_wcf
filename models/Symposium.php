<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "symposium".
 *
 * @property integer $id
 * @property string $symposium_name
 * @property string $dates
 * @property string $times
 * @property integer $what_day
 *
 * @property Participant[] $participants
 * @property Participant[] $participants0
 */
class Symposium extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'symposium';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dates', 'times'], 'safe'],
            [['what_day'], 'integer'],
            [['symposium_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'symposium_name' => 'Symposium Name',
            'dates' => 'Dates',
            'times' => 'Times',
            'what_day' => 'What Day',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipants()
    {
        return $this->hasMany(Participant::className(), ['symposium_day_one_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipants0()
    {
        return $this->hasMany(Participant::className(), ['symposium_day_two_id' => 'id']);
    }
}

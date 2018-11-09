<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dietary_preferences".
 *
 * @property integer $id
 * @property string $special_preference
 *
 * @property Participant[] $participants
 */
class Dietarypreferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dietary_preferences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['special_preference'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'special_preference' => 'Special Preference',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipants()
    {
        return $this->hasMany(Participant::className(), ['dietary_id' => 'id']);
    }
}

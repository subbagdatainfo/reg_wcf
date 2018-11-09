<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registrasi".
 *
 * @property integer $id
 * @property integer $id_participant
 * @property integer $count
 *
 * @property Participant $idParticipant
 */
class Registrasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registrasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_participant'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_participant' => 'Id Participant',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipant()
    {
        return $this->hasOne(Participant::className(), ['id' => 'id_participant']);
    }
}

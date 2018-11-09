<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opening_ceremony_guestbook".
 *
 * @property integer $id
 * @property integer $id_particpant
 * @property string $date
 *
 * @property Participant $idParticpant
 */
class OpeningCeremonyGuestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opening_ceremony_guestbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_particpant'], 'integer'],
            [['date'], 'safe'],
            [['id_particpant'], 'exist', 'skipOnError' => true, 'targetClass' => Participant::className(), 'targetAttribute' => ['id_particpant' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_particpant' => 'Id Particpant',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticpant()
    {
        return $this->hasOne(Participant::className(), ['id' => 'id_particpant']);
    }
}

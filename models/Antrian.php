<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "antrian".
 *
 * @property integer $id
 * @property integer $nomor_antrian_id
 * @property integer $loket_id
 * @property integer $participant_id
 * @property integer $user_id
 *
 * @property Antrian $nomorAntrian
 * @property Antrian[] $antrians
 * @property Loket $loket
 * @property Participant $participant
 * @property User $user
 */
class Antrian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'antrian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomor_antrian_id', 'loket_id', 'user_id'], 'integer'],
            /*[['nomor_antrian_id'], 'exist', 'skipOnError' => true, 'targetClass' => Antrian::className(), 'targetAttribute' => ['nomor_antrian_id' => 'id']],
            [['loket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Loket::className(), 'targetAttribute' => ['loket_id' => 'id']],
            [['participant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Participant::className(), 'targetAttribute' => ['participant_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_antrian_id' => 'Nomor Antrian ID',
            'loket_id' => 'Loket ID',
            'participant_id' => 'Participant ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNomorantrian()
    {
        return $this->hasOne(Nomorantrian::className(), ['id' => 'nomor_antrian_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAntrians()
    {
        return $this->hasMany(Antrian::className(), ['nomor_antrian_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoket()
    {
        return $this->hasOne(Loket::className(), ['id' => 'loket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

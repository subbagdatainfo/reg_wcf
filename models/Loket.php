<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loket".
 *
 * @property integer $id
 * @property string $nama_loket
 * @property string $penanggung_jawab
 *
 * @property Antrian[] $antrians
 */
class Loket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'],'integer'],
            [['nama_loket', 'penanggung_jawab'], 'string'],
            [['is_active'],'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_loket' => 'Nama Loket',
            'penanggung_jawab' => 'Penanggung Jawab',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAntrians()
    {
        return $this->hasMany(Antrian::className(), ['loket_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nomor_antrian".
 *
 * @property integer $id
 * @property integer $nomor
 * @property string $mulai_antri
 * @property string $selesai_antri
 * @property integer $status_antrian
 */
class Nomorantrian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nomor_antrian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_antrian'], 'integer'],
            [['mulai_antri', 'selesai_antri'], 'safe'],
            [['mulai_antri', 'selesai_antri'], 'string'],
            [['nomor'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor' => 'Nomor',
            'mulai_antri' => 'Mulai Antri',
            'selesai_antri' => 'Selesai Antri',
            'status_antrian' => 'Status Antrian',
        ];
    }
}

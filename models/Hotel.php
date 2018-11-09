<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property integer $id
 * @property string $hotel_name
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_name','alamat'], 'string'],
            [['no_tlp'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_name'    => 'Hotel Name',
            'alamat'        => 'Alamat',
            'no_tlp'        => 'No Telepon'
        ];
    }
}

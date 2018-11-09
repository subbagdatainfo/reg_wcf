<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_type".
 *
 * @property integer $id
 * @property string $room_code
 * @property string $room_type
 */
class RoomType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_code', 'room_type'], 'required'],
            [['room_code', 'room_type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_code' => 'Room Code',
            'room_type' => 'Room Type',
        ];
    }
}

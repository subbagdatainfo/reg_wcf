<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attend".
 *
 * @property integer $id
 * @property string $information
 * @property string $note
 */
class Attend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['information'], 'required'],
            [['information', 'note'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'information' => 'Information',
            'note' => 'Note',
        ];
    }
}

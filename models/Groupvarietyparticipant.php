<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_variety_participant".
 *
 * @property integer $id
 * @property string $group_name
 *
 * @property VarietyPartisipant[] $varietyPartisipants
 */
class Groupvarietyparticipant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_variety_participant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => 'Group Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVarietyPartisipants()
    {
        return $this->hasMany(VarietyPartisipant::className(), ['group_participant_id' => 'id']);
    }
}

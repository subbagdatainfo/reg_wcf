<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Groupvarietyparticipant;

/* @var $this yii\web\View */
/* @var $model app\models\Varietypartisipant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="varietypartisipant-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'group_participant_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Groupvarietyparticipant::find()->all(), 'id', 'group_name'),
        'options' => [
            'placeholder' => 'Group Participant',
            'data-toggle' => 'tooltip',
            'data-placement' =>'top',
            'title' => 'Please select from the dropdown menu'
        ],
    ])->label("Participant of Group"); ?>

    <?= $form->field($model, 'variety')->textInput() ?>

    <?= $form->field($model, 'format_invitation_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quota')->textInput() ?>

    <?= $form->field($model, 'facility')->textInput() ?>

    <?= $form->field($model, 'attendance')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Groupvarietyparticipant;


/* @var $this yii\web\View */
/* @var $model app\models\Varietypartisipant */
/* @var $form yii\widgets\ActiveForm */

$group_variety_partisipant = ArrayHelper::map(Groupvarietyparticipant::find()->all(), 'id', 'group_name');
?>

<div class="varietypartisipant-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        
        <div class="col-md-6">

                <?= $form->field($model, 'group_participant_id')->widget(Select2::classname(), [
                    'data' => $group_variety_partisipant,
                    'options' => ['placeholder' => 'Group variety partisipant'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
                <?= $form->field($model, 'format_invitation_code')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'facility')->textInput() ?>
        </div>    
        <div class="col-md-6">
                <?= $form->field($model, 'variety')->textInput() ?>
                <?= $form->field($model, 'quota')->textInput() ?>
                <?= $form->field($model, 'attendance')->textInput(['maxlength' => true]) ?>
        </div>    
    

    </div>

   




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

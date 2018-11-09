<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participant-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'title')->dropDownList([1=>'Mr',2=>'Ms'],['prompt'=>'Title']);?>
        </div>
        <div class="col-md-7">
            <?= $form->field($model, 'full_name')->textInput() ?>
        </div>
        <div class="col-md-2">
            <div class="form-group"><br>
                <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style'=> 'color:white !important;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

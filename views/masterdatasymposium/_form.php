<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Symposium */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="symposium-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'symposium_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dates')->textInput() ?>

    <?= $form->field($model, 'times')->textInput() ?>

    <?= $form->field($model, 'what_day')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

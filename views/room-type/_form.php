<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RoomType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'room_code')->textInput() ?>

    <?= $form->field($model, 'room_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

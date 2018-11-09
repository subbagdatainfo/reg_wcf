<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Representative */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="representative-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'organization') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'assignment_letter') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'room_type') ?>

    <?php // echo $form->field($model, 'attend') ?>

    <?php // echo $form->field($model, 'speaker')->checkbox() ?>

    <?php // echo $form->field($model, 'id_category_participant') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

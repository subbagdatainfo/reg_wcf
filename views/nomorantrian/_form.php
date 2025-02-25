<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nomorantrian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nomorantrian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor')->textInput() ?>

    <?= $form->field($model, 'mulai_antri')->textInput() ?>

    <?= $form->field($model, 'selesai_antri')->textInput() ?>

    <?= $form->field($model, 'status_antrian')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

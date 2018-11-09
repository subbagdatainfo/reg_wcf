<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Symposiumguestbook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="symposiumguestbook-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'participant_id')->textInput() ?>

    <?= $form->field($model, 'symposium_id')->textInput() ?>

    <?= $form->field($model, 'date_entry')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

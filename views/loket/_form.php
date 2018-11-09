<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Loket */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(User::find()->FilterWhere(['like', 'username','loket'])->all(), 'id', 'username')
?>

<div class="loket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_loket')->textInput() ?>

    <?= $form->field($model, 'penanggung_jawab')->textInput() ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
	    'data' => $data,
	    'options' => ['placeholder' => 'Select a state ...'],
	    'pluginOptions' => [
	        'allowClear' => true
	    ],
	])->label('Username'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

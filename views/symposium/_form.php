<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Symposium */
/* @var $form yii\widgets\ActiveForm */

$what_day = [1 => 'Day One', 2 => 'Day Two'];
?>

<div class="symposium-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
			<div class="col-md-6">
				<?= $form->field($model, 'symposium_name')->textInput(['maxlength' => true]) ?>
    			<?= $form->field($model, 'dates')->widget(DatePicker::classname(), [
	    				'name' => 'dates',
					    'type' => DatePicker::TYPE_INPUT,
					    'value' => '23-Feb-1982',
					    'pluginOptions' => [
					        'autoclose'=>true,
					        'format' => 'dd-M-yyyy'
					    ]
    			])->label('Date'); ?>
			</div>

			<div class="col-md-6">
				<?= $form->field($model, 'what_day')->widget(Select2::classname(), [
				    'data' => $what_day,
				    'options' => ['placeholder' => ''],
				    'pluginOptions' => [
				        'allowClear' => true
				    ],
				]); ?>

    			<?= $form->field($model, 'times')->widget(TimePicker::classname(), [
    				'pluginOptions' => [
				        'showSeconds' => true,
				        'showMeridian' => false,
				        'minuteStep' => 1,
				        'secondStep' => 5,
				    ]

    			])->label('Time'); ?>
			</div>
    </div>

    




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

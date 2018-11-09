<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Companion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invitation_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'full_name')->textInput() ?>

    <?= $form->field($model, 'user_photo')->textInput() ?>

    <?= $form->field($model, 'name_on_badge')->textInput() ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput() ?>

    <?= $form->field($model, 'pasport_ktp_number')->textInput() ?>

    <?= $form->field($model, 'place_of_issue')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'fax')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'partisipant')->checkbox() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'organization')->textInput() ?>

    <?= $form->field($model, 'speaker')->checkbox() ?>

    <?= $form->field($model, 'abstract')->textInput() ?>

    <?= $form->field($model, 'file_presentation')->textInput() ?>

    <?= $form->field($model, 'full_paper')->textInput() ?>

    <?= $form->field($model, 'participant_status')->textInput() ?>

    <?= $form->field($model, 'variety_id')->textInput() ?>

    <?= $form->field($model, 'dietary_id')->textInput() ?>

    <?= $form->field($model, 'symposium_day_one_id')->textInput() ?>

    <?= $form->field($model, 'symposium_day_two_id')->textInput() ?>

    <?= $form->field($model, 'date_arrival')->textInput() ?>

    <?= $form->field($model, 'time_arrival')->textInput() ?>

    <?= $form->field($model, 'flight_number_arrival')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_departure')->textInput() ?>

    <?= $form->field($model, 'time_departure')->textInput() ?>

    <?= $form->field($model, 'flight_number_departure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date_attend')->textInput() ?>

    <?= $form->field($model, 'end_date_attend')->textInput() ?>

    <?= $form->field($model, 'visit_subak_bali')->checkbox() ?>

    <?= $form->field($model, 'cultural_visit')->checkbox() ?>

    <?= $form->field($model, 'attend_id')->textInput() ?>

    <?= $form->field($model, 'is_delete')->checkbox() ?>

    <?= $form->field($model, 'handphone')->textInput() ?>

    <?= $form->field($model, 'tell_us')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'candidate_chosen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'essay')->textInput() ?>

    <?= $form->field($model, 'room_type_id')->textInput() ?>

    <?= $form->field($model, 'room_type_approve')->checkbox() ?>

    <?= $form->field($model, 'is_representative')->checkbox() ?>

    <?= $form->field($model, 'is_companion')->checkbox() ?>

    <?= $form->field($model, 'is_companion_valid')->checkbox() ?>

    <?= $form->field($model, 'is_companion_from')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

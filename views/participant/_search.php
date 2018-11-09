<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParticipantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'invitation_code') ?>

    <?= $form->field($model, 'token') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'user_photo') ?>

    <?php // echo $form->field($model, 'name_on_badge') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'pasport_ktp_number') ?>

    <?php // echo $form->field($model, 'place_of_issue') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'partisipant')->checkbox() ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'organization') ?>

    <?php // echo $form->field($model, 'speaker')->checkbox() ?>

    <?php // echo $form->field($model, 'abstract') ?>

    <?php // echo $form->field($model, 'file_prensentation') ?>

    <?php // echo $form->field($model, 'full_paper') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'participant_status') ?>

    <?php // echo $form->field($model, 'variety_id') ?>

    <?php // echo $form->field($model, 'dietary_id') ?>

    <?php // echo $form->field($model, 'symposium_day_one_id') ?>

    <?php // echo $form->field($model, 'symposium_day_two_id') ?>

    <?php // echo $form->field($model, 'date_arrival') ?>

    <?php // echo $form->field($model, 'time_arrival') ?>

    <?php // echo $form->field($model, 'flight_number_arrival') ?>

    <?php // echo $form->field($model, 'eta') ?>

    <?php // echo $form->field($model, 'date_departure') ?>

    <?php // echo $form->field($model, 'time_departure') ?>

    <?php // echo $form->field($model, 'flight_number_departure') ?>

    <?php // echo $form->field($model, 'etd') ?>

    <?php // echo $form->field($model, 'start_date_attend') ?>

    <?php // echo $form->field($model, 'end_date_attend') ?>

    <?php // echo $form->field($model, 'visit_subak_bali')->checkbox() ?>

    <?php // echo $form->field($model, 'cultural_visit')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

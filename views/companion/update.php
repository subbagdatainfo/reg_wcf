<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Companion', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update Registration Data';
?>
<div class="participant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_registration_data', [
        'model' => $model,
        'symposium_day_one_id_is' => $symposium_day_one_id_is,
        'symposium_day_two_id_is' => $symposium_day_two_id_is,
        'quota_culturalvisit' => $quota_culturalvisit
    ]) ?>

</div>

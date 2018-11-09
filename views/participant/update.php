<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */

$this->title = 'Update Participant: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Participant', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="participant-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Symposium */

$this->title = 'Update Symposium: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Symposia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="symposium-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

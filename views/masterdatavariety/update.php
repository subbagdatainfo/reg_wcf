<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Varietypartisipant */

$this->title = 'Update Varietypartisipant: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Varietypartisipants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="varietypartisipant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

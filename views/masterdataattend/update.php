<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attend */

$this->title = 'Update Attend: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attend-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

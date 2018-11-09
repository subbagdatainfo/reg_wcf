<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Varietypartisipant */

$this->title = 'Update Variety partisipant: ' ;
$this->params['breadcrumbs'][] = ['label' => 'Varietypartisipants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->variety, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="varietypartisipant-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

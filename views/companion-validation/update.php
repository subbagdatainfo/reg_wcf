<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Companion */

$this->title = 'Update Companion: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Companions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="companion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

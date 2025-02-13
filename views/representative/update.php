<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Representative */

$this->title = 'Update Representative: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="representative-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

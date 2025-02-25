<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Antrian */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Antrian',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Antrians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="antrian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

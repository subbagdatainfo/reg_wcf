<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Symposium */

$this->title = $model->symposium_name;
$this->params['breadcrumbs'][] = ['label' => 'Symposia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symposium-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'symposium_name',
            'dates',
            'times',
            'what_day',
        ],
    ]) ?>

</div>
<p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
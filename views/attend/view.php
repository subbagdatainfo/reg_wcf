<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Attend */

$this->title = $model->information;
$this->params['breadcrumbs'][] = ['label' => 'Attends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attend-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'information',
            'note',
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
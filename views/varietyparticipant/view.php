<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Varietypartisipant */

$this->title = $model->variety;
$this->params['breadcrumbs'][] = ['label' => 'Varietypartisipants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varietypartisipant-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'variety',

            'format_invitation_code',
            'quota',
            'facility',
            'attendance',
            [
                'attribute'    => 'group_participant_id',
                'value'        =>  $model->group['group_name'],
            ],
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

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attend-index">
    <p class="pull-right">
        <?= Html::a('Create Attend', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'information',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

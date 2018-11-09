<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SymposiumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Symposium';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symposium-index">
    <p class="pull-right">
        <?= Html::a('Create Symposium', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'symposium_name',
            'dates',
            'times',
            'what_day',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

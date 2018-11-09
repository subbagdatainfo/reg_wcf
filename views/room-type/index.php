<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoomTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Room Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Room Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'room_code',
            'room_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

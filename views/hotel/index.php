<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hotels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Hotel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            'hotel_name',
            'alamat',
            'no_tlp',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

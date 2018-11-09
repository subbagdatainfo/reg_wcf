<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SymposiumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Symposia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symposium-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Symposium', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'symposium_name',
            'dates',
            'times',
            'what_day',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

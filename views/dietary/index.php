<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DietarypreferencesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dietarypreferences';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dietarypreferences-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dietarypreferences', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'special_preference',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

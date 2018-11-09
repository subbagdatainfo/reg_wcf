<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupvarietyparticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groupvarietyparticipants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupvarietyparticipant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Groupvarietyparticipant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'group_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

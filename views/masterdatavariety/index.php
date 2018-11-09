<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VarietypartisipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Varietypartisipants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varietypartisipant-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Varietypartisipant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'variety',
                'label'     => 'Category'
            ],
            [
                'value'             => 'format_invitation_code',
                'attribute'         => 'format_invitation_code',
                'label'             => 'Format Invitation Code',
                'contentOptions'    => ['style'=>'width: 100px'],
            ],
            [
                'attribute'         =>  'quota',
                'contentOptions'    => ['style'=>'width: 60px'],

            ],
            'facility',
            // 'attendance',
            // 'group_participant_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

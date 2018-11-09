<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recapitulation';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="recapitulation-index">
	<?php Pjax::begin(); ?>
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'invitation_code',
                'value'     => 'participant.invitation_code',
                'label'     => 'invitation_code',
            ],
            [
                'attribute' => 'id_participant',
                'value'     => 'participant.full_name',
                'label'     => 'full_name',
            ],
            [
                'attribute' => 'organization',
                'value'     => 'participant.organization',
                'label'     => 'organization',
            ],
            // [
            //     'attribute' => 'group_name',
            //     'value'     => 'participant.variety.group.group_name',
            //     'label'     => 'group_name',
            // ],
            [
                'attribute' => 'variety_name',
                'value'     => 'participant.variety.variety',
                'label'     => 'variety_name',
            ],
            [
                'attribute' => 'time',
                'header' => 'Date Attend',
                'value'     => 'time',
            ]

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	<?php Pjax::end(); ?></div>
</div>
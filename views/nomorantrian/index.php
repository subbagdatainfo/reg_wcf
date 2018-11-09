<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NomorantrianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nomorantrians');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomorantrian-index">

   <!--  <h1><?= Html::encode($this->title) ?></h1>
   <?php // echo $this->render('_search', ['model' => $searchModel]); ?> -->

    <p>
        <?= Html::a(Yii::t('app', 'Buat Nomorantrian'), ['create'], ['class' => 'btn btn-success', /*'onclick'=>'setTimeout(CetakKartuAntri, 1000)'*/]) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nomor',
            'mulai_antri',
            'selesai_antri',
            [
                'attribute' => 'status_antrian',
                'value'     => function($model)
                {
                    if($model->status_antrian == 1){
                        $status_antrian = 'Mulai';
                    }elseif($model->status_antrian == 2){
                        $status_antrian = 'Dilayani';
                    }elseif ($model->status_antrian == 3) {
                        $status_antrian = 'Selesai';
                    }else{
                        $status_antrian = 'Lewat';
                    }
                    return $status_antrian;
                },
                'filter'    => [1 => 'Mulai',2 => 'Dilayani',3 => 'Selesai',4 => 'Lewat'],
            ]

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<script type="text/javascript">
    function CetakKartuAntri(){
        window.open(
            'cetak',
            '_blank' // <- This is what makes it open in a new window.
        );
    }
</script>
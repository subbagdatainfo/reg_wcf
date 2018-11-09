<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrasi Partisipant';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-index">

    <center><h1><?= Html::encode($this->title) ?></h1></center>
<!--     <?php // echo $this->render('_search', ['model' => $searchModel]); ?> -->

    

    

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="<?= Url::to(['/registrasi/registrasi-participant']); ?>" method="GET">
                  <div class="form-group">
                        <input type="text" class="form-control" id="focused" name="invitation_code">
                  </div>
            </form>
        </div>
    </div>
    

    <br>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'attribute' =>  'id_participant',
                'label'     => 'Full Name',
                'value'     => function($model){
                    if(!empty($model->id_participant)){
                        $participant =  $model->participant->full_name;
                    }else{
                        $participant = '-';
                    }

                    return $participant;
                }
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>



<?php

$script = '
    
    document.getElementById("focused").focus();

'; 
$this->registerJs($script, \yii\web\View::POS_END); ?>

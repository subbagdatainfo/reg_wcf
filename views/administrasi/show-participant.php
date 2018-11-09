<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use app\models\Varietypartisipant;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrasi Full Subsidy';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="participant-index">
    

    <?php
            $gridColumns = [
                    [
                        'attribute' => 'title',
                        'value'     =>  function($model){
                            if($model->title == 1){
                                $title = "Mr";
                            }elseif($model->title == 2){
                                $title = "Mrs";
                            }elseif($model->title == 3){
                                $title = "Ms";
                            }elseif($model->title == 4){
                                $title = "Mdm";
                            }else{
                                $title = "-";

                            }
                            return $title;
                        },
                        'contentOptions'=>['style'=>'width: 50px;']
                    ],
                    'full_name',
                    'invitation_code',
                    'organization',
                    [

                        'attribute' => 'variety_id',
                        'label'     => 'Variety Participant',
                        'value'     => 'variety.variety',
                    ],


                    [
                        'attribute' => 'variety',
                        'label'     => 'Facility',
                        'format' => 'raw',
                        'value' => function($model){
                            if(!empty($model->variety_id)){
                                $facility = $model->variety->facility;
                            }
                            
                            return $facility;
                        },
                    ],

                    [
                        'attribute' => 'status_subsidi',
                        'label'     => 'Status Administrasi',
                        'format' => 'Html',
                        'value' => function($model){
                            if($model->status_subsidi == 0){
                                $status_subsidi = '<span class="label label-danger">Belum Dibayarkan</span>';
                            }else{
                                $status_subsidi = '<span class="label label-success">Sudah Dibayarkan</span>';
                            }
                            
                            return $status_subsidi;
                        },
                        'filter' => [0 => 'Belum Dibayakan', 1 => 'Sudah Dibayarkan'],
                    ],
                ];


                echo ExportMenu::widget([
                    'dataProvider'  => $dataProvider,
                    'columns'       => $gridColumns,
                    'target'        => ExportMenu::TARGET_BLANK,
                    'filename'      => 'Data Participant',
                    'exportConfig'  => [
                            ExportMenu::FORMAT_TEXT     => false,
                            ExportMenu::FORMAT_PDF      => false,
                            ExportMenu::FORMAT_HTML     => false,
                            ExportMenu::FORMAT_EXCEL    => false,
                            ExportMenu::FORMAT_CSV    => false,
                    ]
                ]);
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'title',
                'value'     =>  function($model){
                    if($model->title == 1){
                        $title = "Mr";
                    }elseif($model->title == 2){
                        $title = "Mrs";
                    }elseif($model->title == 3){
                        $title = "Ms";
                    }elseif($model->title == 4){
                        $title = "Mdm";
                    }else{
                        $title = "-";

                    }
                    return $title;
                },
                'contentOptions'=>['style'=>'width: 50px;']
            ],
            'full_name',
            'invitation_code',
            'organization',
            /*[

                'attribute' => 'variety_id',
                'label'     => 'Variety Participant',
                'value'     => 'variety.variety',
                'filter' => Html::activeDropDownList($searchModel,'variety_id',Arrayhelper::map(Varietypartisipant::find()->where(['id' => [6,2,3,4,5,13,14,20,21,24,1,30,32,25,40,31,34,9,17,23,33]])->asArray()->all(), 'id', 'variety'),['class'  => 'form-control','prompt'  => '-- Select Variety Participant --']),
            ],*/


            /*[
                'attribute' => 'variety',
                'label'     => 'Facility',
                'format' => 'raw',
                'value' => function($model){
                    if(!empty($model->variety_id)){
                        $facility = $model->variety->facility;
                    }
                    
                    return $facility;
                },
            ],*/

            [
                'attribute' => 'status_subsidi',
                'label'     => 'Status Administrasi',
                'format' => 'Html',
                'value' => function($model){
                    if($model->status_subsidi == 0){
                        $status_subsidi = '<span class="label label-danger">Belum Dibayarkan</span>';
                    }else{
                        $status_subsidi = '<span class="label label-success">Sudah Dibayarkan</span>';
                    }
                    
                    return $status_subsidi;
                },
                //'filter' => [0 => 'Belum Dibayakan', 1 => 'Sudah Dibayarkan'],
            ],

            [  
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:100px;'],
                'header'=>'Actions',
                'template' => '{paid} {unpaid}',
                'buttons' => [
                    /*'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ', $url, [
                            'title' => Yii::t('app', 'View')                                 
                        ]);
                    },*/
                    'paid' => function ($url, $model) {
                        return Html::a(' <span class="glyphicon glyphicon-check" style="font-size: 1.6em; aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Dibayarkan'),
                            'onclick'   => 'return confirm("Are you sure want to change to Paid ?")',                                  
                        ]);
                    },
                    'unpaid' => function ($url, $model) {
                        return Html::a(' <span class="glyphicon glyphicon-unchecked" style="font-size: 1.6em;" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Belum Dibayarkan'),
                            'onclick'   => 'return confirm("Are you sure want to change to Unpaid ?")',
                        ]);
                    },
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'paid') {
                        $url ='paid?id='.$model->id;
                        return $url;
                    }elseif ($action === 'unpaid') {
                        $url ='un-paid?id='.$model->id;
                        return $url;
                    }
                }

            ],
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="<?= Url::to(['/administrasi/scan-barcode']); ?>" method="GET">
                  <div class="form-group">
                        <input type="text" class="form-control" id="focused" name="invitation_code">
                  </div>
            </form>
        </div>
    </div>
</div>
<?php

$script = '
    
    document.getElementById("focused").focus();

'; 
$this->registerJs($script, \yii\web\View::POS_END); ?>

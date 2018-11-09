<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\chartjs\ChartJs;
use app\models\Participant;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GpdataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peta';
$this->params['breadcrumbs'][] = $this->title;


$connection = Yii::$app->getDb();
$command = $connection->createCommand('SELECT count(a.id), a.variety_id, b.format_invitation_code, b.variety FROM participant As a JOIN variety_partisipant As b ON a.variety_id = b.id GROUP BY a.variety_id, b.format_invitation_code, b.variety ORDER BY b.format_invitation_code');
$result = $command->queryAll();

//menampunglabel dalam bentuk array
$label 	= [];

//menampung jumlah dalam bentuk array
$jumlah = [];
for ($i=0; $i < count($result); $i++) { 
		
		$label[$i]	= $result[$i]['format_invitation_code'];
		$jumlah[$i]	= $result[$i]['count'];
}



/*//listing peserta yang sudah konfirmasi datang
$listing_connect = Yii::$app->getDb();
$command = $listing_connect->createCommand("SELECT COUNT(a.id) FROM participant AS a  WHERE 'invitaion_code' NOT LIKE '%PUBNAT%' AND invitation_code NOT LIKE '%PUBINT%'");
$listing = $command->queryAll();


print_r($listing);
die();
//menampung jumlah peserta
$jumlah_peserta = [];

for ($i=0; $i < count($listing); $i++) { 
        
        //echo $jumlah_peserta[$i]  = $listing[$i]['count'];
}*/
?>
        <div class="row">
            <div class="col-md-12">
                <h3>Data Statistik</h3>

                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">
                                Statistik Jumlah Invitation Code </a>
                            </li>
                            <li>
                                <a href="#tab_default_2" data-toggle="tab">
                                Statistik Jumlah dan Presentase Peserta Yang Telah Konfirmasi
                                </a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                               
                                    <?= ChartJs::widget([
                                        'type' => 'bar',
                                        'options' => [
                                            'height'    => 300,
                                            'width'     => 400,
                                        ],
                                        'data' => [
                                            'labels' => $label,
                                            'datasets' => [
                                                [
                                                    'label' =>  "Jumlah Invitation Code",
                                                    'borderColor' => "rgba(220,220,220,0.5)",
                                                    'strokeColor' => "rgba(220,220,220,1)",
                                                    'pointColor' => "rgba(220,220,220,1)",
                                                    'backgroundColor'   => "rgba(54, 162, 235, 0.2)",
                                                    'pointStrokeColor' => "#F00",
                                                    'data' => $jumlah,
                                                ],
                                            ],
                                        ]
                                    ]);
                                    ?>
                              
                            </div>
                            <div class="tab-pane" id="tab_default_2">


                                   
                                    
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
<div style="margin-top:20px;"></div>
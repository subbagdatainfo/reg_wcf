<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Attend Registrasi';
$this->params['breadcrumbs'][] = $this->title;

$data_participant = Yii::$app->db->createCommand('SELECT country.country_name, count(country.country_name) FROM registrasi LEFT JOIN participant ON registrasi.id_participant = participant.id LEFT JOIN country ON participant.country_id = country.id GROUP BY country.country_name ORDER BY country.country_name')->queryAll();
$data_participant_by_country    = [];
for ($i=0; $i < count($data_participant); $i++) { 
    if ($data_participant[$i]["country_name"] !== "Indonesia") {
        $data_participant_by_country[$i][0] = $data_participant[$i]["country_name"];
        $data_participant_by_country[$i][1] = $data_participant[$i]["count"];
    }else{
        $data_participant_by_country[$i][0] = $data_participant[$i]["country_name"];
        $data_participant_by_country[$i][1] = $data_participant[$i]["count"];
        unset($data_participant_by_country[$i]);
    }
}

?>
<div class="registrasi-index">

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <button type="button" style="width: 250px; height: 250px; padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 90px; background:white; margin-left:100px;"> 
        All Attend :<br><br>
        <?php if(!empty($all_attend)){ ?>
            <?= $all_attend;?>
        <?php }else{ ?>
            <?= '0'; ?>
        <?php } ?> 
        <br> Participant
    </button>

    <button type="button" style="width: 250px; height: 250px; padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 90px; background:white; margin-left:100px;"> 
        All Participant :<br><br>
        <?php if(!empty($all_participant)){ ?>
            <?= $all_participant;?>
        <?php }else{ ?>
            <?= '0'; ?>
        <?php } ?> 
        <br> Participant
    </button>

    <br>
    <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
    <br>

    
    <?php
        $gridColumns = [

            [
                'attribute' => 'id_participant',
                'value'     => 'participant.full_name',
                'label'     => 'full_name',
            ],
            'participant.variety.group.group_name',
            'participant.variety.variety',
            [
                'attribute' => 'participant',
                'value'     => 'participant.country.country_name',
                'label'     => 'country',
            ],
            [
                'attribute' => 'time',
                'value'     => 'time',
            ],
            [
                'attribute' => 'participant.organization',
                'value'     => 'participant.organization'
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
            ]
        ]);

    ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_participant',
                'value'     => 'participant.full_name',
                'label'     => 'full_name',
            ],
            'participant.variety.group.group_name',
            'participant.variety.variety',
            [
                'attribute' => 'participant',
                'value'     => 'participant.country.country_name',
                'label'     => 'country',
            ],
            [
                'attribute' => 'time',
                'value'     => 'time',
            ]

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<script type="text/javascript">
var chart1; // globally available
$(document).ready(function() {
    chart1 = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        title: {
            text: 'All Participant Attend By Country'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Participant (people)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'WCF 2016 Participant : <b>{point.y} people</b>'
        },
        series: [{
            name: 'Population',
            data: <?= json_encode(array_values($data_participant_by_country));?>,
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
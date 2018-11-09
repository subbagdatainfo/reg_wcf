<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Antrian;
use app\models\Nomorantrian;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AntrianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pengumuman');
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Sarpanch" rel="stylesheet">
<style type="text/css">
    html, body {
        height: 100%;
        margin: 0px;
    }
    .main { padding: 10px; font-family: 'Oswald', sans-serif;}
    .card{
        margin-top: 10px;
        width: 100%;
    }
    h2{
        color: #ff980f;
    }
    .nopadding {
       padding: 0 !important;
       margin: 0 !important;
    }
    .number{
        font-size: 80px;
        font-style: bold;
        text-align: center;
    }
    .loket{
        font-size: 40px;
        padding: 10px;
        text-align: center;
    }
    .tengah {
        vertical-align: middle !important;
        text-align: center;
        font-size: 55px;
        font-style: bold
    }
    .loket-main{
        margin-top: 20px;
        min-height: 100%; 
        height:75vh;
    }
    td{
        vertical-align: middle !important;
        font-size: 40px;
        font-weight: 900;
        font-family: 'Sarpanch', sans-serif;
        letter-spacing: 2px;
        font-style: bold;
        color: #fff;
        border:1px solid #dcdcdc;
    }
    .tbl{
        height:100%;
    }
</style>


<div class="antrian-index">

	<div class="main" >
        <!-- <div class="card" style="border:1px solid;">
            
            
        </div> -->
        <div class="card">

            <div class="col-xs-12 nopadding" style="border:1px solid;">
                <div class="col-xs-12" style="margin-top:10px;padding:20px;">
                    <div class="col-xs-6 nopadding">
                    <!-- <b style="font-size:20px; margin-top:10px;">world culture forum</b>  -->
                        <img style="margin-top:0px; margin-left:-8px;" width="550px;" src="../card/tittle.png">
                    </div>
                    <div class="col-xs-6 nopadding">
                        <img width="150px" style="float:right" src="../card/Layer-6.png">
                    </div>
                </div>
            </div>
        </div>
        <div>
        <div class="col-xs-12 nopadding" style="background:#000; height: 50px; color:#ff980f;">
            <center><h2><div id="tanggal"></div></h2></center>
        </div>
        <div class="col-xs-12 nopadding" style="border:1px solid; background:#353432; color:#fff; height: 100%; ">
            <div class="loket-main">
                 <table class="table tbl" style="margin-top:-20px;">
                    <tbody>
                        <?php for ($i=0; $i < count($loket); $i++) { ;?>
                            <?php if ($i == 0) { ;?>
                                <tr>
                                    <?php 
                                        $nomor_antrian = Antrian::find()->where(["loket_id" => $loket[$i]["id"]])->one();
                                        if ($nomor_antrian) { 
                                            $nomor_antrian = Nomorantrian::find()->where(["id" => $nomor_antrian->nomor_antrian_id, "status_antrian"=>2])->one();

                                            if ($nomor_antrian) { ;?>
                                                <td id="nomor_antrian_id_loket_<?=$loket[$i]["id"];?>"><?= strtoupper($loket[$i]["nama_loket"]);?> = <?= $nomor_antrian->nomor;?></td>
                                            <?php }else{ ;?>
                                                <td id="nomor_antrian_id_loket_<?=$loket[$i]["id"];?>"><?= strtoupper($loket[$i]["nama_loket"]);?> = - </td>
                                            <?php } ;?>
                                        <?php }else{ ;?>
                                        <td id="nomor_antrian_id_loket_<?=$loket[$i]["id"];?>"><?= strtoupper($loket[$i]["nama_loket"]);?> = - </td>
                                    <?php };?>
                                    <td class="tengah" rowspan="<?= count($loket);?>">Next Queque<br><div id="NextQueque" style="font-size: 250px;"><?php if(!empty($antrian_next)){ echo $antrian_next->nomor; }else{ echo '-'; };?></div></td>
                                </tr>
                            <?php }else{ ;?>
                                <tr>
                                    <?php 
                                        $nomor_antrian = Antrian::find()->where(["loket_id" => $loket[$i]["id"]])->one();
                                        if ($nomor_antrian) { 
                                            $nomor_antrian = Nomorantrian::find()->where(["id" => $nomor_antrian->nomor_antrian_id, "status_antrian"=>2])->one();

                                            if ($nomor_antrian) { ;?>
                                                <td id="nomor_antrian_id_loket_<?=$loket[$i]["id"];?>"><?= strtoupper($loket[$i]["nama_loket"]);?> = <?= $nomor_antrian->nomor;?></td>
                                            <?php }else{ ;?>
                                                <td id="nomor_antrian_id_loket_<?=$loket[$i]["id"];?>"><?= strtoupper($loket[$i]["nama_loket"]);?> = - </td>
                                            <?php } ;?>
                                        <?php }else{ ;?>
                                        <td id="nomor_antrian_id_loket_<?=$loket[$i]["id"];?>"><?= strtoupper($loket[$i]["nama_loket"]);?> = - </td>
                                    <?php };?>
                                </tr>
                            <?php };?>
                        <?php };?>
                  </table>
            </div>
        </div>
        <div class="col-xs-12 nopadding">
            <img width="100%" height="30px" src="../ticket/key_03.jpg">
        </div>
    </div>

</div>

<script type="text/javascript">

function doStuffWithData(data,options) {

    var datas = JSON.parse(data);
    var loket = datas["loket"];

    // Tanggal
    document.getElementById("tanggal").innerText = datas["date"];

    // Next queque
    document.getElementById("NextQueque").innerText = datas["next"];

    for (key in loket) {
        document.getElementById(key).innerText = loket[key];
    }

    // Here are all the options: how we got it,
    // and maybe what to do with it
    // console.log(options);
    window.setTimeout(myajaxfunction(options), 500);
}

function myajaxfunction(options){
    $.ajax({
        url: "realtime",
        type: "get",
        datatype:"json",        
        data: {'data':options.database},
        success: function(response){
        // Execute our callback function
            setTimeout(function(){
                options.callback(response,options);
            }, 900);
        }
    });
};

var options = {'data':'hay','callback':doStuffWithData}

myajaxfunction(options)

</script>
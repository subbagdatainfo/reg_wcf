<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AntrianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Antrians');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="antrian-index">

<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <div class="jumbotron">

        <div class="row">
            <div class="col-md-6">
                <a href="<?= Url::to('#'); ?>" onclick="speekResponse('Queque Number <?= $model->nomorantrian->nomor; ?>')" class="btn btn-md btn-danger btn-block">
                    <h3 style="color:white; font-weight:bold; font-size:16px; padding:0; margin:0;">ULANGI PANGGILAN</h3>
                </a>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Nomor Antrian Sekarang adalah</div>
                        <input type="text" class="form-control" value="<?= $model->nomorantrian->nomor; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">

            <div class="col-md-6">
                <a href="<?= Url::to(['antrian/selesai','id' => $model->id]); ?>" class="btn btn-md btn-success btn-block">
                    <h3 style="color:white; font-weight:bold; font-size:16px; padding:0; margin:0;">SELESAI</h3>
                </a>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                        <div class="input-group">
                                <div class="input-group-addon">Jumlah Antrian Yang Sudah Selesai</div>
                                <input type="text" class="form-control" value="<?= $jumlah_antrian_selesai; ?>" readonly>
                        </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="<?= Url::to(['antrian/lewati','id' => $model->id]); ?>" class="btn btn-md btn-warning btn-block">
                    <h3 style="color:white; font-weight:bold; font-size:16px; padding:0; margin:0;">LEWATI</h3>
                </a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group">
                            <div class="input-group-addon">Jumlah Antrian Yang Belum Selesai</div>
                            <input type="text" class="form-control" value="<?= $jumlah_antrian_belum_selesai; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>

        
    </div>


</div>

<script type="text/javascript">

    var voices = window.speechSynthesis.getVoices();

    var sayit = function ()
    {
        var msg = new SpeechSynthesisUtterance();

        msg.voice = voices[10]; // Note: some voices don't support altering params
        msg.voiceURI = 'native';
        msg.volume = 1; // 0 to 1
        msg.rate = 0.6; // 0.1 to 10
        msg.pitch = 0; //0 to 2
        msg.lang = 'en-us';
        msg.onstart = function (event) {

            console.log("started");
        };
        msg.onend = function(event) {
            console.log('Finished in ' + event.elapsedTime + ' seconds.');
        };
        msg.onerror = function(event)
        {

            console.log('Errored ' + event);
        }
        msg.onpause = function (event)
        {
            console.log('paused ' + event);

        }
        msg.onboundary = function (event)
        {
            console.log('onboundary ' + event);
        }

        return msg;
    }


    var speekResponse = function (text)
    {
        speechSynthesis.cancel(); // if it errors, this clears out the error.

        var sentences = text.split(".");
        for (var i=0;i< sentences.length;i++)
        {
            var toSay = sayit();
            toSay.text = sentences[i];
            speechSynthesis.speak(toSay);
        }
    }

    speekResponse("Queque Number <?= $model->nomorantrian->nomor; ?>");

    // document.getElementById("SelectText").select();
    // Speak();
    // function Speak(){
    //     var e = jQuery.Event("keydown");
    //         e.altKey = true;
    //         // e.keyCode = 'a'; // a
    // }

</script>
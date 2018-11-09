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
    

    <?php if(Yii::$app->session->getFlash('error')){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?= Yii::$app->session->getFlash('error'); ?></strong>
        </div>
    <?php }elseif(Yii::$app->session->getFlash('error_loket')){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?= Yii::$app->session->getFlash('error_loket'); ?></strong>
        </div>
    <?php } ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <a href="<?= Url::to('panggil'); ?>" class="btn btn-md btn-warning btn-block">
                    <h3 style="color:white; font-weight:bold; font-size:16px; padding:0; margin:0;">PANGGIL</h3>
                </a>

            </div>
        </div>
        
    </div>


</div>



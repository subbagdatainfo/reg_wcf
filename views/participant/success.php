<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$title = 'Thank you for your registration';

$this->title = $title;
?>

    
    <?php if(Yii::$app->session->getFlash('success')){?>
            <div class="alert alert-success alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
              <strong><?php echo Yii::$app->session->getFlash('success'); ?></strong> 
            </div>
    <?php }else{ ?>
        <?php echo ''; ?>
    <?php } ?>


<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\Registrasi;


$registrasi = Registrasi::find()->where(['id_participant' => $model_participant->id])->one();

/* @var $this yii\web\View */
/* @var $model app\models\Registrasi */

/*$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/

/*if($model->title == 1){
    $title = "Mr";
}elseif($model->title == 2){
    $title = "Mrs";
}elseif($model->title == 3){
    $title = "Ms";
}elseif($model->title == 4){
    $title = "Mdm";
}else{
    $title = '-';
}*/
?>
<div class="registrasi-view">
    
    <div class="jumbotron" style="margin-top:10px;">
        <div class="row">
            <div class="col-md-12">
                <pre style="margin:0; padding:5px; background:white;"><div class="text-center">Registrasi Opening Ceremony</div></pre>
            </div>

            <br>
            <br>
            <br>
            <br>

            <div class="col-md-6">
                    
                <pre style="margin:0; padding:5px; background:white;">INVITATION CODE : <?= $model_participant->invitation_code; ?></pre>
                <h5 style="margin:5px 0; padding:5px 0; font-weight:bold;">Selamat Datang Peserta World Culture Forum 2016</h5 style="margin:0 padding:0;">
                <pre style="margin:0; padding:5px; background:white;">Mr / Ms : <?= $model_participant->full_name; ?></pre>
                
            </div>


            <div class="col-md-6">


                <button type="button" style="width: 120px; height: 120px; padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 60px; background:white; margin-left:100px;"> 

                        <?php if(!empty($count)){ ?>
                                
                                <?= $count;?>
                        
                        <?php }else{ ?>
                                <?= '0'; ?>
                        <?php } ?> 

                </button>
                
            </div>

        </div>

        <br>
        <br>


        <div class="row">
            
            <div class="col-md-6 pull-right">
                <a href="<?= Url::to(['list']); ?>" class="btn btn-primary btn-block">View Participant</a>
            </div>
            
        </div>        
    </div>

    

    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="<?= Url::to(['/opening-registrasi/register']); ?>" method="GET">
                  <div class="form-group">
                        <input type="text" class="form-control" id="focused" name="invitation_code">
                  </div>
            </form>
        </div>
    </div>


</div>


<?php $script = '
    
    document.getElementById("focused").focus();

'; 
$this->registerJs($script, \yii\web\View::POS_END); ?>

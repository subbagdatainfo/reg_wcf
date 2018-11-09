<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistrasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrasi Symposium : ' .$symposium_empat->symposium_name;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-index">

    <center><h2><b><?= Html::encode($this->title) ?></b></h2></center>
<!--     <?php // echo $this->render('_search', ['model' => $searchModel]); ?> -->
 

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <button type="button" style="width: 120px; height: 120px; padding: 10px 16px;font-size: 24px;line-height: 1.33;border-radius: 60px; background:white; margin-left:100px;"> 

                                <?php if(!empty($symposium_guest_count)){ ?>
                                        
                                        <?= $symposium_guest_count;?>
                                
                                <?php }else{ ?>
                                        <?= '0'; ?>
                                <?php } ?> 

            </button>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="<?= Url::to(['/symposium-guest-book/register-hari-kedua']); ?>" method="GET">
                  <div class="form-group">
                        <input type="hidden" class="form-control" name="id" value="4">
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

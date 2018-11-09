<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\Registrasi;

?>
<div class="registrasi-view">
    

        <div class="jumbotron" style="margin-top:10px;">

            <div class="row">
                <div class="col-md-12">
                    <?php if(Yii::$app->session->getFlash('error_kedua')){ ?>
                            <div class="alert alert-danger" role="alert">
                                
                                <strong style="padding:20px;"><?= Yii::$app->session->getFlash('error_kedua') ?></strong>

                            </div>
                    <?php } ?>
                </div>
                
            </div>
            <br>       
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

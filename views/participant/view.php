<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\Registrasi;


$registrasi = Registrasi::find()->where(['id_participant' => $model->id])->one();

/* @var $this yii\web\View */
/* @var $model app\models\Registrasi */

/*$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/

if($model->title == 1){
    $title = "Mr";
}elseif($model->title == 2){
    $title = "Mrs";
}elseif($model->title == 3){
    $title = "Ms";
}elseif($model->title == 4){
    $title = "Mdm";
}else{
    $title = '-';
}

if(!empty($model->country->country_name)){
    $country = $model->country->country_name;
}else{
    $country = '<span style="margin-left:78px;">-</span>';
}

if(!empty($model->room->room_type)){
    $room = $model->room->room_type;
}else{
    $room = '<span style="margin-left:108px;">-</span>';
}


if(!empty($model->symposiumdayone->symposium_name)){
    $symposium_day_one = $model->symposiumdayone->symposium_name;
}else{
    $symposium_day_one = '<span style="margin-left:40px;">-</span>';

}

if(!empty($model->symposiumdaytwo->symposium_name)){
    $symposium_day_two = $model->symposiumdaytwo->symposium_name;
}else{
    $symposium_day_two = '<span style="margin-left:40px;">-</span>';

}

if(!empty($model->hotel_id)){
    $hotel = $model->hotel->hotel_name;
}else{
    $hotel = '<span style="margin-left:40px;">-</span>';
}

 $role_user = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
    foreach ($role_user as $key => $value) {
        $role_user = $key;
}
?>
<div class="registrasi-view">
        

    <?php if($role_user == 'rolesuper'){ ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Update', ['update-invitation', 'id' => $model->id],[
            'class' => 'btn btn-primary',
        ]) ?>
    <?php } ?>


    <div class="jumbotron" style="margin-top:10px;">
        

        <div class="row">
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'invitation_code',
                    ],
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'variety.variety',
                    ],
                ]) ?>
            </div>


            <div class="col-md-6">
                

               <?php if ($model->user_photo) { ;?>
                    <img src="<?= Url::home(true).'uploads/user_photo/'.$model->user_photo ;?>" class="thumbnail" style="max-height:250px;max-width:250px;">
                <?php }else{ ;?>
                    <img src="<?= Url::home(true).'no_image.gif';?>" class="thumbnail" style="max-height:250px;max-width:250px;"    >
                <?php };?>


            </div>

            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'title',
                            'value'     => $title,
                        ],
                        'full_name',
                        [
                            'label'     => 'Nationality',
                            'attribute' => 'nationality',
                            'format'    => 'html',
                            'value'     => $country,

                        ],
                        'organization',
                    ],
                ]) ?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label'     => 'Symposium day one',
                            'attribute' => 'symposium_day_one_id',
                            'format'    => 'html',
                            'value'     => $symposium_day_one,
                        ],

                    ],
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label'     => 'Symposium day two',
                            'attribute' => 'symposium_day_two_id',
                            'format'    => 'html',
                            'value'     => $symposium_day_two,
                        ], 
                    ],
                ]) ?>
            </div>
        </div>


        <div class="row">

            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label'     => 'Hotel',
                            'attribute' => 'hotel_id',
                            'value'     => $hotel,
                            'format'    => 'html',

                        ], 
                    ],
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label'     => 'Room Type',
                            'attribute' => 'room_type_id',
                            'format'    => 'html',
                            'value'     => $room
                        ], 
                    ],
                ]) ?>
            </div>
        
        </div>

        

        <div class="row">
            <div class="col-md-6">
                <!-- Indicates a successful or positive action -->
                <?php if(empty($registrasi)){ ?>
                    <?= Html::a('Attend', ['registrasi/attend', 'id' => $model->id], ['class' => 'btn btn-success btn-block']) ?>
                <?php }else{ ?>
                    <center><b>Partisipan Sudah Hadir</b></center>
                <?php } ?>

            </div>

            <div class="col-md-6">
           
                <?= Html::a('Print Badge', ['badge', 'id' => $model->id], ['class' => 'btn btn-primary btn-block','target' => '_blank']) ?>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                 <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label'     => 'Counter Print Badge',
                                'attribute' => 'counter',
                                'format'    => 'html',
                                'value'     => $model->counter,
                            ], 
                        ],
                    ]) ?>
            </div>
        </div>
    </div>
    


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="<?= Url::to(['/registrasi/registrasi-participant']); ?>" method="GET">
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

<?php

use yii\helpers\Url;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\RoomType;

/* @var $this yii\web\View */
/* @var $model app\models\Representative */

$this->title = 'Request Representative from : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="representative-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($model->approval == FALSE) { ;?>

    
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="alert alert-info" role="alert">
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'room_type')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(RoomType::find()->all(), 'id', 'room_type'),
                    'options' => [
                        'placeholder' => 'Room Type',
                        'data-toggle' => 'tooltip',
                        'data-placement' =>'top',
                        'title' => 'Please select from the dropdown menu'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label("Room of Type"); ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'approval')->checkbox(['style'=>'margin-bottom: -1px !important;']) ?>
            </div>
            <div class="col-md-2">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary','style' => 'color:white !important;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php }else{ ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
            <strong>The representative has approved.</strong> 
        </div>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'full_name',
            'room.room_code',
            'attending.information',
            'speaker:boolean',
            'varietyparticipant.variety',
            'name',
            'organization',
            'position',
            // http://reg.local/ubuntu-gnome-15-10-beta-2-screenshot-tour-a-gnome-3-16-desktop-done-right-492759-3.jpg
            [
                'label' => 'assignment_letter',
                'format' => 'html',
                'value' => '<a href="'.Url::to('web/uploads/assignment_letter/'.$model->assignment_letter, true).'" target="_blank">Download Assignment Letter</a>',
            ],
        ],
    ]) ?>

</div>

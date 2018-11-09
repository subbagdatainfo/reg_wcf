    <?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use app\models\Varietypartisipant;
use app\models\Participant;
use app\models\Attend;
use app\models\Symposium;
use app\models\Dietarypreferences;
use app\models\Country;
use kartik\widgets\FileInput;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Representative';
$this->params['breadcrumbs'][] = $this->title;

// 1 = Mr, 2 = Ms
if ($model->title == 1) {
    $title = 'Mr';
}elseif ($model->title == 2) {
    $title = 'Ms';
}

?>

<div class="representative-form">
    
    <div class="container" style="margin-top: 70px;">
        <div class="row s">
            <div class="col-md-12 col-sm-12">

                <div class="jumbotron">
                    <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Representative</h4>
                    <hr class="style-one">
                    <?php $form = ActiveForm::begin(); ?>
                    “<b><?= $title;?>, <?= $model->full_name;?></b> will you be attending WCF 2016 by yourself ?”<br><br>

                    <div style="margin-top:5px;">
                        <div class="col-xs-6">
                            <?= Html::Button('No, I am a representative of <b>'.$title.', '.$model->full_name.'</b>', ['name' => 'submit-button-no', 'onclick' => 'ActionNo()', 'class' => 'btn btn-default btn-block', 'style' => 'color:black !important;']) ?>
                        </div>
                        <div class="col-xs-6">
                            <?= Html::submitButton('Yes', ['name' => 'submit-button-yes','class' => 'btn btn-success btn-block', 'onclick' => 'ActionYes()', 'style' => 'color:white !important;']) ?>
                        </div>
                    </div>&nbsp;

                    <?php ActiveForm::end(); ?>
                </div>

                <div id="hiddenform" style="display:none">

                    <div class="jumbotron">
                        <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Form</h4>
                        <hr class="style-one">
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                            <?= $form->field($data_representative, 'name') ?>

                            <?= $form->field($data_representative, 'organization') ?>

                            <?= $form->field($data_representative, 'position') ?>

                            <?= $form->field($data_representative, 'assignment_letter')->widget(FileInput::classname(), ['options' => ['accept' => '*']])->label('Assignment Letter'); ?>

                            <div class="form-group">
                                <?= Html::submitButton($data_representative->isNewRecord ? 'Submit' : 'Submit', ['class' => $data_representative->isNewRecord ? 'btn btn-success col-md-12' : 'btn btn-primary col-md-12']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function ActionYes(){
        document.getElementById('hiddenform').style = 'display:none';
    }

    function ActionNo(){
        document.getElementById('hiddenform').style = 'display:block';
    }
</script>
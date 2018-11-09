<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\editable\Editable;
use app\models\Participant;

$participant = Participant::find()->where(["id" => $model->id])->all();
$model = Participant::findOne($model->id);
?>
<div class="table-responsive">
	<table class="table table-hover table-bordered">
		<tr>
			<th>Personal Statement</th> 
			<th>Motivation</th>
			<th style="width: 100px;">Essay</th>
		</tr>
		<?php foreach ($participant as $row_participant) { ?>

			<tr>
				<td><div style="color:black; font-weight:bold;"><?= $row_participant->tell_us; ?></div</td>
				<td><div style="color:black; font-weight:bold;"><?= $row_participant->candidate_chosen; ?></div</td>
				<td><div style="color:black; font-weight:bold;"><?= Html::a('Essay',Url::home(true).'uploads/essay/'.$row_participant->essay,['target' => '_blank']); ?></div></td>
			</tr>

		<?php } ?>
	</table>
	<table class="table table-hover table-bordered">
		<tr>
			<th>Organization</th> 
			<th>Address</th>
		</tr>
		<?php foreach ($participant as $row_participant) { ?>

			<tr>
				<td><div style="color:black; font-weight:bold;"><?= $row_participant->organization; ?></div</td>
				<td><div style="color:black; font-weight:bold;"><?= $row_participant->address; ?></div</td>
			</tr>

		<?php } ?>
	</table>
</div>

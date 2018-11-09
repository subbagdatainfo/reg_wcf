<?php 

use yii\helpers\Html;
use app\models\Companion;
use yii\widgets\ActiveForm;

$datas_companion = Companion::find()->where(["is_companion_from"=>$model->id])->AsArray()->All();
?>

<div class="table-responsive">
	<table class="table table-hover table-bordered">
		<tr>
			<th style="width: 50px;">Title</th>
			<th>Full Name of Companion</th> 
			<th style="width: 100px;">Status</th> 
			<th style="width: 100px;">Validation</th>
		</tr>
		<?php for ($i=0; $i < count($datas_companion); $i++) { ;?>
		<tr>
			<td><?php if($datas_companion[$i]["title"] == 1) { echo 'Mr' ; }else{ echo 'Ms'; }; ?></td>
			<td><?= $datas_companion[$i]["full_name"]; ?></td> 
			<td><center><?php if($datas_companion[$i]["is_companion_valid"] == TRUE) { echo '<span class="label label-success">Approved</span>' ; }else{ echo '<span class="label label-danger">Not Approved</span>'; }; ?></center></td> 
			<td><center>
				<?php if($datas_companion[$i]["is_companion_valid"] == TRUE) {;?>
					<?= Html::a('Disapproving', ['disapproving', 'id' => $datas_companion[$i]["id"]], ['class' =>'btn btn-danger btn-xs', 'style'=>'color:white !important;','data' => ['confirm' => "Are you sure you want to disapproving this companion?",'method' => 'post']]) ?>
				<?php }else{ ;?>
					<?= Html::a('Approving', ['approving', 'id' => $datas_companion[$i]["id"]], ['class' =>'btn btn-success btn-xs', 'style'=>'color:white !important;','data' => ['confirm' => "Are you sure you want to approving this companion?",'method' => 'post']]) ?>
				<?php };?>
			</center></td>
		</tr>
		<?php };?>
	</table>
</div>
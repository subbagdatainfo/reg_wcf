<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use barcode\barcode\BarcodeGenerator;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

/* @var $this yii\web\View */
/* @var $model app\models\Participant */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Participant', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if($model->title == 1){
    $title = "Mr";
}elseif($model->title == 2){
    $title = "Mrs";
}elseif($model->title == 3){
    $title = "Ms";
}elseif($model->title == 4){
    $title = "Mdm";
}

?>

<div class="participant-view">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><b><center>ENTRANCE TICKET – INVITED PARTICIPANT</center></b></h3>
		</div>
		<div class="panel-body"><center>
			<table class="tg">
				<tr>
					<th class="tg-yw4l"><center><b>INVITATION CODE : </b><br><?= $model->invitation_code;?></center></th>
					<th class="tg-yw4l" colspan="2"><center><b>WORLD CULTURE FORUM</b><br>“Culture for an Inclusive Sustainable Planet”</center></th>
					<th class="tg-yw4l"><center><img src="<?= Url::to('/web/LOGO.png', true);?>" alt="Smiley face" height="100" width="90"></center></th>
				</tr>
				<tr>
					<td class="tg-yw4l" rowspan="3"><center><b>PHOTO : </b><br>  </center></td>
				</tr>
				<tr>
					<td class="tg-yw4l"><center><b>DATE : </b><br> XXX </center></td>
					<td class="tg-yw4l" rowspan="2"><center><b>PHOTO : </b><br>  </center></td>
					<td class="tg-yw4l"><center><b>NAME : </b><br> <?= $model->full_name;?> </center></td>
					<td class="tg-yw4l"><center><b>ARRIVAL : </b><br> XXX </center></td>
				</tr>
				<tr>
					<td class="tg-yw4l"><center><b>LOCATION : </b><br> BNDCC, BALI, INDONESIA</center></td>
					<td class="tg-yw4l"><center><b>ATTENDING AS : </b><br> <?= $model->variety->variety;?> </center></td>
					<td class="tg-yw4l"><center><b>DEPARTURE : </b><br> XXX </center></td>
				</tr>
				<tr>
					<td class="tg-yw4l"><center><b>BARCODE : </b><br><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('"'.$model->invitation_code.'"', $generator::TYPE_CODE_128, 2, 80)) . '">';; ?></center></td>
					<td class="tg-yw4l"><center><b>SYMPOSIUM DAY 1 : </b><br> <?php if ($model->symposium) { echo $model->symposium->symposium_name; }else{ echo '-' ;}; ?></center></td>
					<td class="tg-yw4l"><center><b>SYMPOSIUM DAY 2 : </b><br> <?php if ($model->symposium) { echo $model->symposium->symposium_name; }else{ echo '-' ;}; ?> </center></td>
					<td class="tg-yw4l"><center><b>PARTICIPANT : </b><br> <li>SUBAK VISIT : <?= $model->visit_subak_bali;?></li><li>CULTURAL VISIT : <?= $model->cultural_visit;?></li> </center></td>
				</tr>
			</table></center>
		</div>
	</div>

</div>

<?php

use yii\helpers\Url;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

/* @var $this yii\web\View */
/* @var $model app\models\Participant */

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
</head>
<body>

<div class="wrap">
<div class="rows" >
	<div class="main-content" >
	
		<div class="col-xs-12 nopadding">
			<img height="50px" width="100%" src="<?= Url::to('/web/ticket/key_03.jpg', true);?>">
			<div class="judul-tiket"><h4><b>ENTRANCE TICKET - INVITED PARTICIPANT</b></h4></div>
		</div>

		<!-- sisi kiri -->
		<div class="col-xs-4 nopadding" style="border-left:1px solid; border-bottom:2px solid;">
			<img height="353px" width="100%" src="<?= Url::to('/web/ticket/gbr.png', true);?>">
			<div class="col-xs-11 nopadding">
				<div class="col-xs-3 nopadding border-kanan">
					<div class="text-tiket">
						Date: <br>
						<span class="f20"><b>10-14</b></span> <br>
						October, 2016 <br>
					</div>
				</div>
				<div class="col-xs-3 nopadding border-kanan">
					<div class="text-tiket">
						Location: <br>
						<span class="f20"><b>BNDCC</b></span> <br>
						Bali, Indonesia
					</div>
				</div>
				<div class="col-xs-6 nopadding border-kanan">
					<div class="text-tiket"> <!-- nanti mainin padding nya aja sesuain sama barcod aslinya -->
						<center><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('"'.$model->invitation_code.'"', $generator::TYPE_CODE_128, 1, 60)) . '">'; ?></center>
					</div>
				</div>
			</div>
		</div>

		<!-- SISI KANAN -->
		<div class="col-xs-7 nopadding">
			<div class="col-xs-12 nopadding">
				<div class="col-xs-3 nopadding border-all">
					<div class="text-tiket">
						Invitation<br> code :<br>
						<b><?= $model->invitation_code;?></b>
					</div>
				</div>
				<div class="col-xs-7 nopadding border-all" align="center">
					<div class="text-tiket">
						<!-- <img height="67px" width="350px" src="../../ticket/label.png"> -->
						<span class="f20" ><img style="margin-top:9px;" width="99%" src="<?= Url::to('/web/ticket/label.png', true);?>"> </span> 
						
					</div>
				</div>
				<div class="col-xs-2 nopadding border-all">
					<div class="text-tiket" align="center">
						<img style="margin-top:-10%;" width="70%" src="<?= Url::to('/web/ticket/logo-wcf.png', true);?>">
					</div>
				</div>
			</div>

			<div class="col-xs-12 nopadding">
				<div class="col-xs-8 nopadding border-all2" style="border-bottom:2px solid; border-left:1px solid;">
					<div class="col-xs-3">
						<div class="text-tiket">
							<img width="100px" src="<?= Url::to('/web/ticket/anisbw.png', true);?>">
						</div>
					</div>
					<div class="col-xs-9">
						<div class="text-tiket" style="margin-top:10px;">
							Name: <br>
							<span class="f20 capslock" ><b><?= $model->full_name;?></b></span> <p></p>
							Attending: <br>
							<span class="f20 capslock" ><b><?= $model->variety->variety;?></b></span> 
						</div>
					</div>
				</div>
				<div class="col-xs-4 nopadding border-all2">
					<div class="col-xs-12 border150" style="border-bottom:2px solid; ">
						<div class="text-tiket">
							Arrival: <br>
							<b class="capslock">- 10 OCT 2016</b>
						</div>
					</div>
					<div class="col-xs-12 border150">
						<div class="text-tiket">
							DEPARTURE: <br>
							<b class="capslock">- 14 OCT 2016</b>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 nopadding">
				<div class="col-xs-6 nopadding border150" style="border-bottom:1px solid;border-right:1px solid; border-left:1px solid;">
					<div class="col-xs-12 text-tiket">
						SYMPOSIUM 1 : <br>
						<b class="capslock"><?php if ($model->symposium) { echo $model->symposium->symposium_name; }else{ echo '-' ;}; ?></b>
					</div>
				</div>
				<div class="col-xs-6 nopadding border150" style="border-bottom:1px solid;border-right:1px solid;">
					<div class="col-xs-12 text-tiket">
						SYMPOSIUM 2 : <br>
						<b class="capslock"><?php if ($model->symposium) { echo $model->symposium->symposium_name; }else{ echo '-' ;}; ?></b>
					</div>
				</div>
			</div>

			<div class="col-xs-12 nopadding">
				<div class="col-xs-12 nopadding border-all-110" style="border-bottom:2px solid; border-left:0px solid;">
					<div class="col-xs-12 text-tiket">
						PARTISIPATION : <br>
						<b>
							<div class="col-xs-6 text-tiket">
								SUBAK VISIT : <br>
								<?php if ($model->visit_subak_bali) { echo $model->visit_subak_bali; }else{ echo 'No' ;}; ?>
							</div>
							<div class="col-xs-6 text-tiket">
								CULTURAL VISIT : <br>
								<?php if ($model->cultural_visit) { echo $model->cultural_visit; }else{ echo 'No' ;}; ?>
							</div>
						</b>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12 nopadding">
			<img height="20px" width="100%" src="<?= Url::to('/web/ticket/key_03.jpg', true);?>">
		</div>
	</div>
</div>

</div>
</body>
</html>

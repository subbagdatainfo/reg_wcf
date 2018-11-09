<?php
use yii\helpers\Url;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>


<div class="row" >
	<div class="row" >
		<div class="col-xs-12">
			<img width="100%" src="<?= Url::to('/web/ticket/key_03.jpg', true);?>">
			<center><div width="100%" class="judul-tiket"><h4><b style="color: white;font-size: 35px;">ENTRANCE TICKET - INVITED PARTICIPANT</b></h4></div></center>
		</div>
	</div>

	<div class="row" >

		<!-- sisi kiri -->
		<div class="col-xs-6" style="padding-right: -5px;">

			<div class="row" style="margin: 0px 0px 0px 0px;">
				<img width="99%" src="<?= Url::to('/web/ticket/gbr.png', true);?>">

					<div class="col-xs-3" style="height:100px; border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
						<div class="text-tiket">
							Date: <br>
							<span class="f20"><b>10-14</b></span> <br>
							October 2016 <br>
						</div>
					</div>
					<div class="col-xs-3" style="height:100px; border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
						<div class="text-tiket">
							Location: <br>
							<span class="f20"><b>BNDCC</b></span> <br>
							Bali, Indonesia
						</div>
					</div>
					<div class="col-xs-5" style="height:100px; border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px;">
						<div class="text-tiket">
							Barcode: <br>
							<center><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('"'.$model->invitation_code.'"', $generator::TYPE_CODE_128, 2, 68)) . '">'; ?></center>
						</div>
					</div>

			</div>
			
		</div>

		<!-- SISI KANAN -->
		<div class="col-xs-6" style="padding-right: -25px;">

			<div class="row" style="padding-left: -15px;margin: 0px 0px 0px 0px;">

				<div class="col-xs-3" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						Invitation<br> code :<br>
						<b><?= $model->invitation_code;?></b>
					</div>
				</div>
				<div class="col-xs-6" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						<!-- <img height="67px" width="350px" src="../../ticket/label.png"> -->
						<span class="f20" ><img style="margin-top:20px;" width="94%" src="<?= Url::to('/web/ticket/label.png', true);?>"> </span> 
						
					</div>
				</div>
				<div class="col-xs-2" style="padding-left: 0px; padding-right: 30px;">
					<div class="text-tiket" align="center" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
						<img style="margin-top:-2px;" width="50%" src="<?= Url::to('/web/ticket/logo-wcf.png', true);?>">
					</div>
				</div>
			</div>

			<div class="row" style="padding-left: -15px;margin: 0px 0px 0px 0px;">

				<div class="col-xs-12" style="width:92.5%; border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="col-xs-3" style="margin: 0px 0px 0px 0px;padding-left: 0px;padding-right: 0px;">
					<?php 
					if ($model->user_photo) { 
						$photo = $model->user_photo; 
					}else{ 
						$photo = 'no-img.jpg';
					}; 
					?>
						<img style="margin: 20px 5px 20px 20px;" max-width="150px" src="<?= Url::to('web/uploads/user_photo/'.$photo, true);?>">
					</div>
					<div class="col-xs-9" style="margin: 0px 0px 0px 0px;padding-left: 0px;padding-right: 0px;">
						<div class="text-tiket">
							Name: <br>
							<b class="f20"><?= $model->full_name;?></b>
							<br>Attending: <br>
							<b class="f20"><?= $model->variety->variety;?></b>
							<br>Nasionality: <br>
							<b class="f20"><?php if ($model->nationality) { echo $model->country->country_name; }else{ echo '-' ;}; ?></b>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="padding-left: -15px;margin: 0px 0px 0px 0px;">

				<div class="col-xs-5" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						Arrival : <br>
						<b class="capslock">
							<?php  if(empty($model->date_arrival)){ ?>
								<?= '<p align="center" padding:0; margin:0;>-</p>'; ?>
							<?php }else{ ?>
								<?= $model->date_arrival; ?>
							<?php }	?>
						</b>
					</div>
				</div>
				<div class="col-xs-6" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						Departure : <br>
						<b class="capslock">
							<?php  if(empty($model->date_departure)){ ?>
								<?= '<p align="center" padding:0; margin:0;>-</p>'; ?>
							<?php }else{ ?>
								<?= $model->date_departure; ?>
							<?php }	?>
						</b>
					</div>
				</div>

			</div>

			<div class="row" style="padding-left: -15px;margin: 0px 0px 0px 0px;">
				<div class="col-xs-5" style="height:130px; border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						SYMPOSIUM 1 : <br>
						<b class="capslock"><?php if ($model->symposium) { echo $model->symposium->symposium_name; }else{ echo '-' ;}; ?></b>
					</div>
				</div>
				<div class="col-xs-6" style="height:130px; border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						SYMPOSIUM 2 : <br>
						<b class="capslock"><?php if ($model->symposium) { echo $model->symposium->symposium_name; }else{ echo '-' ;}; ?></b>
					</div>
				</div>
			</div>

			<div class="row" style="padding-left: -15px;margin: 0px 0px -20px 0px;">
				<div class="col-xs-5" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						SUBAK VISIT : 
						<b class="capslock"><?php if ($model->visit_subak_bali) { echo 'Yes'; }else{ echo 'No' ;}; ?></b>
					</div>
				</div>
				<div class="col-xs-6" style="border-color: black;border-width: 1px;border-style: groove; margin: 0px 0px 0px 0px; padding-right: 1px; padding-left: 1px;">
					<div class="text-tiket">
						CULTURAL VISIT : 
						<b class="capslock"><?php if ($model->cultural_visit) { echo 'Yes'; }else{ echo 'No' ;}; ?></b>
					</div>
				</div>
			</div>

		</div>

	</div>

	<div class="row">
		<div class="col-xs-12" style="margin-top: -2px;margin-left: 1px;">
			<img height="20px" width="100%" src="<?= Url::to('/web/ticket/key_03.jpg', true);?>">
		</div>
	</div>

</div>

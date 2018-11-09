<?php
use yii\helpers\Url;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>


<div class="row col-xs-12" style="border-color: black;border-width: 1px;border-style: groove;padding-right: 1000px;">
	<div class="row">
		<div class="col-xs-12">
			<img width="50%" src="<?= Url::to('/web/ticket/key_03.jpg', true);?>">
		</div>
	</div>

	<div class="row" >
		<div class="row" >
			<div class="col-xs-5 pull-right" style="padding-right: 130px;margin-top: 10px;">
				<img width="20%" src="<?= Url::to('/web/card/Logo_deret.png', true);?>">
			</div>
		</div>
		<div class="row" >
			<div class="col-xs-12" style="padding-left: 25px;">
				<img width="50%" src="<?= Url::to('/web/card/tittle.png', true);?>">
			</div>
		</div>
		<div class="row" >
			<div class="col-xs-12" style="padding-left: 63px;">
				10 - 14 OCTOBER 2016 | BALI - INDONESIA
			</div>
		</div>

		<?php if ($model->user_photo) {  $photo = $model->user_photo;  }else{  $photo = 'no-img.jpg'; }; ?>
		<div class="row" >
			<div class="col-xs-12" style="padding-left: 85px;">
				<center><img style="margin: 20px 20px 20px 20px;max-width: 200px;" src="<?= Url::to('web/uploads/user_photo/'.$photo, true);?>"></center>
			</div>
		</div>

		<div class="row" >
			<div class="col-xs-12" style="padding-left: 50px;">
				<b class="f20"><?= $model->full_name;?></b>
			</div>
		</div>

		<div class="row" >
			<div class="col-xs-12" style="padding-left: 50px;">
				<b class="f20"><?= $model->variety->variety;?></b>
			</div>
		</div>

		<div class="row" >
			<div class="col-xs-12" style="padding-left: 90px;margin-top: 20px;">
				<b class="f20">INV. CODE : <?= $model->invitation_code;?></b>
			</div>
		</div>

		<?php
		if ($model->room->room_code == 'SG4') {
			$color_room = 'orange';
		}elseif ($model->room->room_code == 'SG3') {
			$color_room = 'red';
		}elseif ($model->room->room_code == 'SH3') {
			$color_room = 'green';
		}elseif ($model->room->room_code == 'SH4') {
			$color_room = 'blue';
		}
		?>
		<div class="row" style="padding-left: 30px;">
			<div class="col-xs-5" style="padding-left: 30px;margin-top: 5px;">
				<div class="col-xs-2" style="background-color:<?= $color_room;?>;height: 50px;border-color: black;border-width: 1px;border-style: groove;">
					<h4><b style="color: white"><?= $model->room->room_code;?></b></h4>
				</div>
				<div class="col-xs-7" style="border-color: black;border-width: 1px;border-style: groove;height: 50px;">
					<center><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('"'.$model->invitation_code.'"', $generator::TYPE_CODE_128, 2, 68)) . '">'; ?></center>
				</div>
			</div>
		</div>

		<div class="row" >
			<div class="col-xs-6" style="height: 20px;"></div>
		</div>

	</div>

	<div class="row">
		<div class="col-xs-12" style="margin-top: -2px;margin-left: 1px;">
			<img height="20px" width="50%" src="<?= Url::to('/web/ticket/key_03.jpg', true);?>">
		</div>
	</div>

</div>

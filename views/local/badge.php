<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<?php
use yii\helpers\Url;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>

<div style="width:100%;font-family: 'Fjalla One', sans-serif;">

	<!-- <div class="row col-xs-12" style="border-color: black;border-width: 1px;border-style: groove;"> -->
		<div class="col-md-12" style="margin-bottom:30px;">
			<center>
				<img style="margin-left: 40%;margin-top:8px" width="100px" src="<?= Url::to('/web/card/Layer-6.png', true);?>">
				<p style="text-align:center;"><span style="font-size:10px;"><b>10 - 14 OCTOBER 2016 | BALI - INDONESIA</b></span></p>
			</center>
		</div>
		<div class="rows">
		

			<!-- Kondisi -->

				<!-- ========================	VVIP	========================================= -->
				<?php if ( in_array($model->variety_id, [1, 2]) ) { ;?>
					<div style="margin-top:-35px;background:#fe0000;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#fff;"><b><?= $model->variety->variety; ?></b></div>
					</div>
				<!-- ========================	VIP	========================================= -->
				<?php }elseif ( in_array($model->variety_id, [3, 4, 5, 8,10, 11, 12, 13, 14, 15, 16, 17, 18, 20, 21, 22, 23, 24, 26, 30, 36]) ) { ;?>
					<div style="margin-top:-35px;background:#fd7100;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#fff;"><b><?= $model->variety->variety; ?></b></div>
					</div>
				<!-- ========================	REGULAR	========================================= -->
				<?php }elseif ( in_array($model->variety_id, [6,7,9,19, 25, 27, 28, 29, 31, 32, 33, 35, 37, 38, 39, 41, 42, 43, 44, 45, 54,55,]) ) { ;?>
					<div style="margin-top:-35px;background:#025fe0;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#fff;"><b><?= $model->variety->variety; ?></b></div>
					</div>
				<!-- ========================	MEDIA	========================================= -->
				<?php }elseif ( in_array($model->variety_id, [34,62]) ) { ;?>
					<div style="margin-top:-35px;background:#ffef03;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#000;"><b><?= $model->variety->variety; ?></b></div>
					</div>
				<!-- ========================	COMMITTIE	========================================= -->
				<?php }elseif ( in_array($model->variety_id, [40, 46, 47, 48, 49, 50, 51, 52, 53, 56, 57, 58, 59, 60]) ) { ;?>
					<div style="margin-top:-35px;background:#5cb85c;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#000;"><b><?= $model->variety->variety; ?></b></div>
					</div>
				<!-- ========================	SECURITY	========================================= -->
				<?php }elseif ( in_array($model->variety_id, [61]) ) { ;?>
					<div style="margin-top:-35px;background:#000;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#fff;"><b><?= $model->variety->variety; ?></b></div>
					</div>
				<?php }else{?>
				<!-- ======================== NO FORMAT	========================================= -->

					<div style="margin-top:-35px;background:#fff;width: 100%; height:35px; z-index:99; text-align:center;">
						<div style="margin-top:5px;font-size:20px; font-style:bold;color:#000;"><b>NO FORMAT</b></div>
					</div>
				<?php }; ?>
			<!-- Kondisi -->


			<div style="margin-top:-33px;height:250px; z-index:99; text-align:left;">
				<div style="margin-left:30px; margin-top:35px; font-size:18px; font-style:bold;text-transform: uppercase;";><b><?= substr($model->full_name , 0,25);?></b></div>
				<div style="margin-left:30px; font-size:14px; font-style:bold;">
					<?php if ($model->nationality) { echo strtoupper($model->relnationality->country_name); }else{ echo '-' ;}; ?>
					<p style="margin:0 padding:0">
						<?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->invitation_code, $generator::TYPE_CODE_128, 2.4, 40)) . '">'; ?>

					</p>
					<p style="font-size:12px; margin:0; padding:0; text-align:center; margin-left:10px;"><?= chunk_split($model->invitation_code,1). '	'; ?></p>
				</div>
				<div style="background:#000; height:1px; z-index:99;margin-top:10.2px">
				
				</div>
				<img height="20px" width="100%" src="<?= Url::to('/tiket/assets/key_03.jpg', true);?>"> 
				<div style="position:absolute; letter-spacing: 2px; font-size:10px; text-align:center; margin-top:-17px; color:#fff;"><b>www.worldcultureforum-bali.org</b></div>
			</div>
		</div>
	<!-- </div> -->

</div>

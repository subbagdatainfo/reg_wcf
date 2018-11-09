<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<?php
use yii\helpers\Url;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>

<div id="documentId" style="width:100%;font-family: 'Fjalla One', sans-serif;">

	<!-- <div class="row col-xs-12" style="border-color: black;border-width: 1px;border-style: groove;"> -->
	<div class="col-md-12">
		<center>
			<img style="margin-left: 40%;margin-top:8px" width="100px" src="<?= Url::to('/web/card/Layer-6.png', true);?>">
			<p style="text-align:center;"><span style="font-size:10px;"><b>10 - 14 OCTOBER 2016 | BALI - INDONESIA</b></span></p>
		</center>

		<!-- Kondisi -->
		<div style="background:#4e7cd0;width: 100%; height:35px; z-index:99; text-align:center;">
			<div style="margin-top:1px;font-size:20px; font-style:bold;color:#fff;"><b>Queque Card</b></div>
		</div>
		<!-- Kondisi -->

		<h4 style="margin-top:-2px;margin-bottom:-2px;text-align: center; font-size: 60px;"><b><?= $model->nomor;?></b></h4>

		<img height="20px" width="100%" src="<?= Url::to('/tiket/assets/key_03.jpg', true);?>"> 
		<div style="position:absolute; letter-spacing: 2px; font-size:10px; text-align:center; margin-top:-17px; color:#fff;"><b>www.worldcultureforum-bali.org</b></div>
	</div>

</div>

<script type="text/javascript">

	var doc = document.getElementById("documentId");
	doc.print();

	//Wait until PDF is ready to print    
	if (typeof doc.print === 'undefined') {    
		console.log("undefined");
	    setTimeout(function(){printDocument("documentId");}, 1000);
	} else {
		console.log("print");
	    doc.print();
	}

</script>
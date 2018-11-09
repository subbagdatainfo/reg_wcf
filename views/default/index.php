<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

?>
<style type="text/css">
	html {
    height: 100%
}

</style>
<body class="orange">
<?php $this->beginBody() ?>

        <section id="three">
			 <div class="col-md-6 nopadding">
			 	<header id="header" class="bg-kiri">
					<div class="container3">
						<div class="col-sm-12">
							<div class="capslock">
								<h2>
									Invited participant
								</h2>
								<br>
									If You Have Invitation Letter From World Culture Forum 2016. You Can Click Link Below to Register Your Email and Input the Invitation code as well as the token which is written at the invitation letter.

							</div>
							<p></p>
							<a style="margin-top:40px;" href="participant/confirmation" class="btn-lg btn-warning btn_home">Confirmation</a>
						</div>
						
					</div>
				</header>
			 </div>
			 <div class="col-md-6 nopadding">
			 	<header id="header" class="bg-kanan">
					<div class="container4">
						<div class="col-sm-12">
							<div class=" capslock">
								<h2 style="color:#000;">
									Open Public Participant
								</h2>
								<br>
									Please register yourself as Public participant if you do not have invitation letter from World Culture Forum 2016. The selected participant will be announced in September, 15th 2016.
							</div>
							<p></p>
							<a style="margin-top:40px; text-decoration:none" href="#" class="btn-lg btn-warning btn_home">Registration Has Been closed</a>
						</div>
						
					</div>
				</header>
			 </div> 	
		</section> 

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; world culture forum </p>

        <p class="pull-right"></p>
    </div>
</footer>
 -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

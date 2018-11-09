<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$role_user = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
foreach ($role_user as $key => $value) {
    $role_user = $key;
}
$home_url = Yii::$app->homeUrl;
if($role_user == 'rolesuper'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}elseif($role_user == 'roleadmin'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}elseif($role_user == 'rolewdb'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}elseif($role_user == 'rolelocal'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}elseif($role_user == 'roleinternational'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}elseif($role_user == 'Public-User'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}elseif($role_user == 'Invitation-User'){
    $home_url = Yii::$app->homeUrl . 'dashboard';
}
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/icon.png" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <?php $this->title = 'World Culture Forum'; ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

<style type="text/css">
.navbar-inverse .navbar-nav > li > a {
    color: #ffffff !important;
    background: #0f7f12;
    font-weight: bold;

}

.navbar-inverse .navbar-header .navbar-brand {
    color: #ffffff !important;
    background: #0f7f12;
    text-transform: !important;
    font-weight: bold;
} 

.navbar-inverse .navbar-nav > li > a:hover{
  color: #ffffff !important;
  background: #184E1C !important;
  font-weight: bold;
}
.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus {

    background: #184E1C !important;
}

.modal-header{background: #0f7f12; color: #fff;}
.pil{margin-top: -10px;}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #fff;
    background-color: #2d9b38;
}
.badge{
    background: #5ab733;
}


</style>
</head>
<body>
<?php $this->beginBody() ?>


    <?php
        NavBar::begin([
            'brandLabel' => '<img style="width:35px; margin-top:-10px;"src=' . Yii::getAlias("@web") . '/images/logo-wcf.png>',
            'brandUrl' => $home_url,
            'options' => [
                'class' => 'navbar navbar-default navbar-fixed-top',
                'innerContainerOptions' => false
            ],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar-right','innerContainerOptions' => ['class'=>'container-fluid']],
            'encodeLabels' => false,
            'items' => [
                $role_user == 'register' || Yii::$app->user->isGuest ? ( "" ) : (
                    ['label' => 'Invited Participant Guidelines', 'url' => ['/INVITATIONCONFIRMATIONGUIDELINES.pdf'], 'linkOptions' => ['target' => '_blank']]
                ),
                $role_user == 'register' || Yii::$app->user->isGuest ? ( "" ) : (
                    ['label' => 'General Information', 'url' => ['/dashboard/index']]
                ),
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/user/login']]
                ) : (
                    // '<li>' . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form']) . Html::submitButton( 'Logout (' . Yii::$app->user->identity->username . ')',['class' => 'btn btn-link']). Html::endForm(). '</li>'
                    ['label' => '<span class="glyphicon glyphicon-user"> </span> ' . Yii::$app->user->identity->username,
                        'items' => [
                            // ['label' => 'Profile','url' => ['/user/settings/account']],
                            ['label' => 'Logout [' .Yii::$app->user->identity->username. ']','url' => ['/user/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],
                    ]
                ),        
            ],
        ]);

        NavBar::end();
    ?>
        <div class="containersw">
            <?= $content ?>
        </div>

<div class="spacer">
    &nbsp;
</div>
<footer class="footer" style="position:fixed; bottom:0;">
    <div class="col-md-5">
         <p class="pull-left">
                    <a href="https://www.facebook.com/WorldCultureForum/"><i class="gdlr-icon fa fa-facebook fa-footer" style="color: #3b5998; font-size: 25px; " ></i></a> 

                    <a href="https://twitter.com/Culture_Forum"><i class="gdlr-icon fa fa-twitter fa-footer" style="color: #55acee; font-size: 25px; " ></i></a>

                    <a href="https://www.instagram.com/worldcultureforum/"><i class="gdlr-icon fa fa-instagram fa-footer" style="color: #e95950; font-size: 25px; " ></i></a>

                    <a href="https://plus.google.com/u/1/112001790588502941014"><i class="gdlr-icon fa fa-google-plus fa-footer" style="color: #dd4b39; font-size: 25px; " ></i></a> 
         </p>
    </div>
    <div class="col-md-7">
         <p class="pull-right fa-footer">© Copyright World Culture Forum 2016, All Right Reserved.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

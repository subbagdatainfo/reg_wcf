<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\widgets\SideNav;
use yii\web\AssetBundle;
use mdm\admin\components\Helper;
use app\models\Participant;

$this->title = 'Registration Participant';
$role_user = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
foreach ($role_user as $key => $value) {
    $role_user = $key;
}

$check_for_menu_ticket = Participant::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

if ($check_for_menu_ticket) {
    if ($check_for_menu_ticket->symposium_day_one_id) {
        $condition_menu_ticket = '<a href="{url}" target="_blank">{icon} {label}</a>';
    }else{
        $condition_menu_ticket = '<a href="{url}">{icon} {label}</a>';
    }
}else{
    $condition_menu_ticket = '<a href="{url}">{icon} {label}</a>';
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

$participant_model  = Participant::find()->where(["user_id"=>Yii::$app->user->identity->id])->one();
if ($participant_model) {
    $status_companion   = Participant::find()->where(["is_companion_from"=>$participant_model->id])->one();
}else{
    $status_companion   = FALSE;
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
</head>
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
    background-color: #ff980f;
}
.badge{
    background: #5ab733;
}
</style>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
     <?php
        NavBar::begin([
            'brandLabel' => '<img style="width:35px; margin-top:-10px;"src=' . Yii::getAlias("@web") . '/images/logo-wcf.png>',
            'brandUrl' => $home_url,
            'options' => [
                'class' => 'navbar-inverse',
                'class' => 'navbar navbar-default',
                'innerContainerOptions' => false
            ],
        ]);
        // echo Html::a('Link', ['www.google.com'], ['target'=>'_blank']);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right','innerContainerOptions' => ['class'=>'container-fluid']],
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
   
    <div class="container" style="padding: 0px 0px 0px 0px;">

        <?php if ( Url::current() !== '/web/user/login' && Url::current() !== '/web/user/register' && Url::current() !== '/web/user/settings/account' && Url::current() !== '/web/user/settings/profile' &&  Url::current() !== '/web/user/forgot' && Url::current() !== '/web/user/resend' && $role_user !== 'register' && $role_user !== 'Invitation-User' && $role_user !== 'Public-User' && $role_user !== 'Public-User-Submit' && $role_user !== 'Invitation-User-Representative' && $role_user !== 'administrasi_role' && $role_user !== 'Dyandra' && $role_user !== 'registrasi_role_dyandra') { ?>  <!-- Tidak Menampilkan sidebar pada menu login dan register -->
            <div class="row">
                <div class="col-md-9">
                    <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
                </div>
                <div class="col-md-2" style="margin-top:5px;">
                    <?= Html::a('New Invitation', ['participant/create'], ['class' => 'btn btn-md btn-success', 'style' => 'width: 100%;']) ?>
                </div>
                <div class="col-md-1" style="margin-top:5px;">
                    <?= Html::a('Quota', ['quota/index'], ['class' => 'btn btn-md btn-success']) ?>
                </div>
            </div>
        <?php }else{ ;?>        
            <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
        <?php };?>

        <?php if ( Url::current() !== '/web/user/login' && Url::current() !== '/web/user/register' && Url::current() !== '/web/user/settings/account' && Url::current() !== '/web/user/settings/profile' &&  Url::current() !== '/web/user/forgot' && Url::current() !== '/web/user/resend') { ?>  <!-- Tidak Menampilkan sidebar pada menu login dan register -->

            <div class="row">
                <div class="col-lg-3 col-md-12 col-xs-12">
                    <?php
                        if (Yii::$app->user->isGuest) {

                            echo "";
                        }else{

                        $menuSidebar = [
                            [
                                'url' => ['/dashboard/index/'],
                                'label' => Yii::t('app','General information'),
                                'icon' => 'cog',
                                'active' => (Yii::$app->controller->id === 'dashboard')
                            ],
                        ];

                        // $menuSidebar[] = [
                        //     'url' => ['/participant/confirmation'],
                        //     'label' => Yii::t('app','Confirmation'),
                        //     'icon' => 'ok',
                        //     'active' => (Yii::$app->controller->id === 'participant' && Yii::$app->controller->action->id === 'confirmation')
                        // ];

                        


                        
                        if($role_user == 'Public-User'){

                            $menuSidebar = [
                                [
                                    'url' => ['/dashboard/index/'],
                                    'label' => Yii::t('app','General information'),
                                    'icon' => 'cog',
                                    'active' => (Yii::$app->controller->id === 'dashboard')
                                ],
                            ];

                            

                            $menuSidebar[] = [
                                'url' => ['/participant/registration', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Registration Data'),
                                'icon' => 'th-list',
                                'active' => $this->context->route == 'participant/registration'
                            ];

                        }elseif($role_user == 'Dyandra'){

                            $menuSidebar[] = [
                                'url' => ['/participant/index'],
                                'label' => Yii::t('app','All Data'),
                                'icon' => 'envelope',
                                'active' => $this->context->route == 'participant/index'
                                
                            ];

                            $menuSidebar[] = [
                                'url' => ['/participant/symposium'],
                                'label' => Yii::t('app','All Data Participant Symposium'),
                                'icon' => 'envelope',
                                'active' => $this->context->route == 'participant/symposium'
                                
                            ];

                            $menuSidebar[] = [
                                'url' => ['/registrasi/index'],
                                'label' => Yii::t('app','All Attend'),
                                'icon' => 'envelope',
                                'active' => $this->context->route == 'registrasi/index'
                            ];

                            $menuSidebar[] = [
                                'label' => 'Print Badge WDB',
                                'icon' => 'print',
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Speaker'),
                                        'icon'=>'certificate',
                                        'url'=>['/wdb/speaker-badge'],
                                        'active' => (Yii::$app->controller->action->id === 'speaker-badge')
                                    ],
                                    [
                                        'label' => Yii::t('app','Symposium'),
                                        'icon'=>'certificate',
                                        'url'=>['/wdb/symposium-badge'],
                                        'active' => (Yii::$app->controller->action->id === 'symposium-badge')
                                    ],
                                    [
                                        'label' => Yii::t('app','IYF'),
                                        'icon'=>'certificate',
                                        'url'=>['/wdb/iyf-badge'],
                                        'active' => (Yii::$app->controller->action->id === 'iyf-badge')
                                    ]
                                ],
                            ];

                            $menuSidebar[] = [

                            
                        
                                'label' => Yii::t('app','Print Badge Invited'),
                                'icon' => 'print',
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Local'),
                                        'url'=>['/local/print-badge-local-invited'],
                                        'active' => (Yii::$app->controller->action->id === 'print-badge-local-invited')
                                    ],
                                    [
                                        'label' => Yii::t('app','International'),
                                        'url'=>['/international/print-badge-international-invited'],
                                        'active' => (Yii::$app->controller->action->id === 'print-badge-international-invited')
                                    ],
                                ],

                            ];
                            $menuSidebar[] = [

                            
                        
                                'label' => Yii::t('app','Print Badge Public'),
                                'icon' => 'print',
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Local'),
                                        'url'=>['/local/print-badge-local'],
                                        'active' => (Yii::$app->controller->action->id === 'print-badge-local')
                                    ],
                                    [
                                        'label' => Yii::t('app','International'),
                                        'url'=>['/international/print-badge-international'],
                                        'active' => (Yii::$app->controller->action->id === 'print-badge-international')
                                    ],
                                ],

                            ];
                            $menuSidebar[] = [

                                'icon'      => 'print',
                                'label'     => Yii::t('app','Print Name On Badge Custom'),
                                'url'       => ['/printnameonbadge/name-on-badge'],
                                'active'    => (Yii::$app->controller->action->id === 'name-on-badge' || (Yii::$app->controller->action->id === 'print' && Yii::$app->getRequest()->getQueryParam('invitation_code')))
                                    

                            ];

                            $menuSidebar[] = [

                            
                        
                                'label' => Yii::t('app','Registrasi'),
                                'icon' => 'user',
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Attend Registrasi'),
                                        'url'=>['/registrasi/check'],
                                        'active' => (Yii::$app->controller->action->id === 'check' || (Yii::$app->controller->action->id === 'registrasi-participant' && Yii::$app->getRequest()->getQueryParam('invitation_code')))
                                    ],

                                    [
                                        'label' => Yii::t('app','Symposium Hari Pertama'),
                                        'icon' => 'th-list',
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Symposium 1'),
                                                'url'=>['/symposium-guest-book/symposium-satu'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-satu' || Yii::$app->getRequest()->getQueryParam('id') ==1)
                                            ],
                                              
                                            [
                                                'label' => Yii::t('app','Symposium 2'),
                                                'url'=>['/symposium-guest-book/symposium-dua'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-dua' || Yii::$app->getRequest()->getQueryParam('id') ==2)
                                            ],

                                            [
                                                'label' => Yii::t('app','Symposium 3'),
                                                'url'=>['/symposium-guest-book/symposium-tiga'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-tiga' || Yii::$app->getRequest()->getQueryParam('id') ==3)
                                            ],
                                        ],
                                    ],

                                    [
                                        'label' => Yii::t('app','Symposium Hari Kedua'),
                                        'icon' => 'th-list',                                        
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Symposium 4'),
                                                'url'=>['/symposium-guest-book/symposium-empat'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-empat' || Yii::$app->getRequest()->getQueryParam('id') ==4)
                                            ],

                                            [
                                                'label' => Yii::t('app','Symposium 5'),
                                                'url'=>['/symposium-guest-book/symposium-lima'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-lima' || Yii::$app->getRequest()->getQueryParam('id') ==5)
                                            ],

                                            [
                                                'label' => Yii::t('app','Symposium 6'),
                                                'url'=>['/symposium-guest-book/symposium-enam'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-enam' || Yii::$app->getRequest()->getQueryParam('id') ==6)
                                            ],
                                        ],
                                    ],

                                    [
                                        'label' => Yii::t('app','Attend Opening Ceremony'),
                                        'url'=>['/opening-registrasi/index'],
                                        'active' => (Yii::$app->controller->id === 'opening-registrasi')
                                    ],
 

                                ],



                            ];

                            $menuSidebar[] = [

                            
                        
                                'label' => Yii::t('app','Hotel'),
                                'icon' => 'home',
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Daftar List Hotel'),
                                        'url'=>['/hotel/index'],
                                        'active' => (Yii::$app->controller->id === 'hotel' && Yii::$app->controller->action->id === 'index')
                                    ],

                                    [
                                        'label' => Yii::t('app','Participant Hotel Public'),
                                        'icon' => 'th-list',                                        
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Local'),
                                                'url'=>['/hotel/participant-hotel'],
                                                'active' => (Yii::$app->controller->action->id === 'participant-hotel')
                                            ],
                                            [
                                                'label' => Yii::t('app','International'),
                                                'url'=>['/hotel/participant-hotel-international'],
                                                'active' => (Yii::$app->controller->action->id === 'participant-hotel-international')
                                            ],
                                        ],
                                    ],

                                    [
                                        'label' => Yii::t('app','Participant Hotel Invited'),
                                        'icon' => 'th-list',                                        
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Local'),
                                                'url'=>['/hotel/participant-local-invited'],
                                                'active' => (Yii::$app->controller->action->id === 'participant-local-invited')
                                            ],
                                            [
                                                'label' => Yii::t('app','International'),
                                                'url'=>['/hotel/participant-international-invited'],
                                                'active' => (Yii::$app->controller->action->id === 'participant-international-invited')
                                            ],
                                        ],
                                    ]


                                    
                                ],

                            ];

                            

                            
                           /* $menuSidebar[] = [
                                'url' => ['/local/print-badge', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Print Badge Local Participant'),
                                'icon' => 'th-list',
                                'active' => $this->context->route == 'local/print-badge'
                            ];

                            $menuSidebar[] = [
                                'url' => ['/international/print-badge', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Print Badge International Participant'),
                                'icon' => 'th-list',
                                'active' => $this->context->route == 'international/print-badge'
                            ];*/

                        }elseif($role_user == 'registrasi_role_dyandra'){

                            $menuSidebar[] = [

                            
                        
                                'label' => Yii::t('app','Registrasi'),
                                'icon' => 'user',
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Attend Registrasi'),
                                        'url'=>['/registrasi/check'],
                                        'active' => (Yii::$app->controller->action->id === 'check' || (Yii::$app->controller->action->id === 'registrasi-participant' && Yii::$app->getRequest()->getQueryParam('invitation_code')))
                                    ],

                                    [
                                        'label' => Yii::t('app','Symposium Hari Pertama'),
                                        'icon' => 'th-list',
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Symposium 1'),
                                                'url'=>['/symposium-guest-book/symposium-satu'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-satu' || Yii::$app->getRequest()->getQueryParam('id') ==1)
                                            ],
                                              
                                            [
                                                'label' => Yii::t('app','Symposium 2'),
                                                'url'=>['/symposium-guest-book/symposium-dua'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-dua' || Yii::$app->getRequest()->getQueryParam('id') ==2)
                                            ],

                                            [
                                                'label' => Yii::t('app','Symposium 3'),
                                                'url'=>['/symposium-guest-book/symposium-tiga'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-tiga' || Yii::$app->getRequest()->getQueryParam('id') ==3)
                                            ],
                                        ],
                                    ],

                                    [
                                        'label' => Yii::t('app','Symposium Hari Kedua'),
                                        'icon' => 'th-list',                                        
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Symposium 4'),
                                                'url'=>['/symposium-guest-book/symposium-empat'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-empat' || Yii::$app->getRequest()->getQueryParam('id') ==4)
                                            ],

                                            [
                                                'label' => Yii::t('app','Symposium 5'),
                                                'url'=>['/symposium-guest-book/symposium-lima'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-lima' || Yii::$app->getRequest()->getQueryParam('id') ==5)
                                            ],

                                            [
                                                'label' => Yii::t('app','Symposium 6'),
                                                'url'=>['/symposium-guest-book/symposium-enam'],
                                                'active' => (Yii::$app->controller->action->id === 'symposium-enam' || Yii::$app->getRequest()->getQueryParam('id') ==6)
                                            ],
                                        ],
                                    ],

                                    [
                                        'label' => Yii::t('app','Attend Opening Ceremony'),
                                        'url'=>['/opening-registrasi/index'],
                                        'active' => (Yii::$app->controller->id === 'opening-registrasi')
                                    ],
 

                                ],



                            ];

                        }elseif($role_user =='administrasi_role'){ 

                            $menuSidebar[] = [
                                'url' => ['/participant/recapitulation'],
                                'label' => Yii::t('app','Participant Recapitulation'),
                                'icon' => 'list-alt',
                                'active' => $this->context->route == 'participant/recapitulation'
                            ];

                            $menuSidebar[] = [
                                'url' => ['/participant/index'],
                                'label' => Yii::t('app','All Data'),
                                'icon' => 'envelope',
                                'active' => $this->context->route == 'participant/index'
                            ];

                            $menuSidebar[] = [
                                'url' => ['/administrasi/all-data-administrasi'],
                                'label' => Yii::t('app','All Data Administrasi'),
                                'icon' => 'envelope',
                                'active' => (Yii::$app->controller->action->id == 'all-data-administrasi')
                            ];


                            $menuSidebar[] = [
                                'label' => 'Administrasi',
                                'icon' => 'cog',
                                'items' => [
                                    [
                                        'url' => ['/administrasi/index'],
                                        'label' => Yii::t('app','Full Subsidy'),
                                        'active' => (Yii::$app->controller->id === 'administrasi' &&  Yii::$app->controller->action->id === 'index')
                                    ],
                              
                                    
                                    [
                                        'label' => Yii::t('app','All Invited'),
                                        'url'=>['/administrasi/export-local-invited'],
                                        'active' => (Yii::$app->controller->action->id === 'export-local-invited')
                                    ],

                                    [
                                        'label' => Yii::t('app','Public'),
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Local'),
                                                'url'=>['/administrasi/export-local-public'],
                                                'active' => (Yii::$app->controller->action->id === 'export-local-public')
                                            ],
                                            [
                                                'label' => Yii::t('app','International'),
                                                'url'=>['/administrasi/export-international-public'],
                                                'active' => (Yii::$app->controller->action->id === 'export-international-public')
                                            ],
                                        ],
                                    ]
                                ],
                            ];

                            $menuSidebar[] = [

                                'icon'      => 'barcode',
                                'label'     => Yii::t('app','Scan Barcode'),
                                'url'       => ['/administrasi/scan'],
                                'active'    => (Yii::$app->controller->action->id === 'scan' || Yii::$app->getRequest()->getQueryParam('invitation_code'))
                                    

                            ];

                            $menuSidebar[] = [

                            
                                'label' => 'Manajemen Antrian',
                                'icon' => 'cog',
                                'items' => [
                                    [
                                        'url' => ['/nomorantrian/index'],
                                        'label' => Yii::t('app','Meja Antrian'),
                                        'active' => (Yii::$app->controller->id === 'nomorantrian' &&  Yii::$app->controller->action->id === 'index')
                                    ],
                              
                                    
                                    [
                                        'label' => Yii::t('app','Pengumuman Antrian'),
                                        'url'=>['/antrian/pengumuman'],
                                        'active' => (Yii::$app->controller->id === 'antrian' && Yii::$app->controller->action->id === 'pengumuman')
                                    ],

                                    [
                                        'label' => Yii::t('app','Antrian'),
                                        'url'=>['/antrian/index'],
                                        'active' => (Yii::$app->controller->id === 'antrian' && Yii::$app->controller->action->id === 'index')
                                    ],

                                    [
                                        'label' => Yii::t('app','Loket'),
                                        'items' => [
                                            [
                                                'label' => Yii::t('app','Daftar Loket'),
                                                'url'=>['/loket/index'],
                                                'active' => (Yii::$app->controller->id === 'loket' && Yii::$app->controller->action->id === 'index')
                                            ],
                                            [
                                                'label' => Yii::t('app','Buat Loket'),
                                                'url'=>['/loket/create'],
                                                'active' => (Yii::$app->controller->id === 'loket' && Yii::$app->controller->action->id === 'create')
                                            ],
                                        ],
                                    ],

                                ],
                            ];

                           /* $menuSidebar[] = [
                                [
                                    'url' => ['/administrasi/scan'],
                                    'label' => Yii::t('app','Scan For Paid'),
                                    'icon' => 'barcode',
                                    'active' => (Yii::$app->controller->action->id === 'scan')
                                ],
                            ];*/


                        }elseif($role_user == 'Public-User-Submit') {
                            $menuSidebar = [
                                [
                                    'url' => ['/dashboard/index/'],
                                    'label' => Yii::t('app','General information'),
                                    'icon' => 'cog',
                                    'active' => (Yii::$app->controller->id === 'dashboard')
                                ],
                            ];


                            $menuSidebar[] = [
                                'url' => ['/participant/registration', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Registration Data'),
                                'icon' => 'th-list',
                                'active' => $this->context->route == 'participant/registration'
                            ];

                            $menuSidebar[] = [
                                'url' => ['/participant/application-status'],
                                'label' => Yii::t('app','Application Status'),
                                'icon' => 'bullhorn',
                                'active' => (Yii::$app->controller->action->id === 'application-status')
                            ];
                        }elseif($role_user == 'Invitation-User') {
                            
                            $menuSidebar = [
                                [
                                    'url' => ['/dashboard/index/'],
                                    'label' => Yii::t('app','General information'),
                                    'icon' => 'cog',
                                    'active' => (Yii::$app->controller->id === 'dashboard')
                                ],
                            ];

                            $menuSidebar[] = [
                                'url' => ['/participant/re-registration', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Registration Data'),
                                'icon' => 'th-list',
                                'active' => $this->context->route == 'participant/re-registration'
                            ];
                        }elseif($role_user == 'Invitation-User-Representative') {
                            
                            $menuSidebar = [
                                [
                                    'url' => ['/dashboard/index/'],
                                    'label' => Yii::t('app','General information'),
                                    'icon' => 'cog',
                                    'active' => (Yii::$app->controller->id === 'dashboard')
                                ],
                            ];

                            $menuSidebar[] = [
                                'url' => ['/participant/representative-status'],
                                'label' => Yii::t('app','Representative Status'),
                                'icon' => 'bullhorn',
                                'active' => (Yii::$app->controller->action->id === 'representative-status')
                            ];
                        }

                        // if($role_user == 'Public-User' || $role_user == 'Invitation-User'){
                        //     $menuSidebar[] = [
                        //         'url' => ['/participant/card', 'id' => Yii::$app->user->identity->id],
                        //         'label' => Yii::t('app','Print ID Card'),
                        //         'icon' => 'file',
                        //         'active' => $this->context->route == 'participant/card',
                        //         'template'=> '<a href="{url}" target="_blank">{icon} {label}</a>',
                        //     ];
                        // }

                        if($role_user == 'Public-User' || $role_user == 'Invitation-User'){
                            $menuSidebar[] = [
                                'url' => ['/participant/ticket', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Print Ticket'),
                                'icon' => 'file',
                                'active' => $this->context->route == 'participant/ticket',
                                'template'=> $condition_menu_ticket,
                            ];

                            $menuSidebar[] = [
                                'url' => ['/sendticket/send-ticket-to-email', 'id' => Yii::$app->user->identity->id],
                                'label' => Yii::t('app','Send Ticket To Email'),
                                'icon' => 'envelope',
                                'active' => $this->context->route == 'sendticket/send-ticket-to-email',
                                'template'=> $condition_menu_ticket,
                                
                            ];

                            if ($status_companion) {
                                $menuSidebar[] = [
                                    'url' => ['/companion/index'],
                                    'label' => Yii::t('app','Guest Companion'),
                                    'icon' => 'glass',
                                    'active' => (Yii::$app->controller->id === 'companion')
                                ];
                            }
                        }

                        $menuSidebar[] = [
                            'url' => ['/participant/recapitulation'],
                            'label' => Yii::t('app','Participant Recapitulation'),
                            'icon' => 'list-alt',
                            'active' => $this->context->route == 'participant/recapitulation'
                        ];

                        $menuSidebar[] = [
                            'url' => ['/participant'],
                            'label' => Yii::t('app','All Data'),
                            'icon' => 'envelope',
                            'active' => $this->context->route == 'participant/index'
                            
                        ];

                        $menuSidebar[] = [
                            'url' => ['/registrasi/index'],
                            'label' => Yii::t('app','All Data Attend'),
                            'icon' => 'envelope',
                            'active' => $this->context->route == 'registrasi/index'
                        ];

                        $menuSidebar[] = [
                            'url' => ['/participant/symposium'],
                            'label' => Yii::t('app','All Data Participant Symposium'),
                            'icon' => 'envelope',
                            'active' => $this->context->route == 'participant/symposium'
                            
                        ];

                        $menuSidebar[] = [
                            'url' => ['/administrasi/all-data-administrasi'],
                            'label' => Yii::t('app','All Data Administrasi'),
                            'icon' => 'envelope',
                            'active' => (Yii::$app->controller->action->id == 'all-data-administrasi')
                        ];

                        // if($role_user == 'rolesuper'){
                        $menuSidebar[] = [
                            'label' => Yii::t('app','Representative Validation'),
                            'url' => ['/representative/index'],
                            'icon' => 'random',
                            'active' => $this->context->route == 'representative/index'
                        ];
                        
                        $menuSidebar[] = [
                            'label' => Yii::t('app','Guest Companion Validation'),
                            'url' => ['/companion-validation/index'],
                            'icon' => 'glass',
                            'active' => (Yii::$app->controller->id === 'companion-validation')
                        ];
                        // }
                        $menuSidebar[] = [
                            'label' => 'WDB',
                            'icon' => 'paperclip',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Speaker'),
                                    'icon'=>'certificate',
                                    'url'=>['/wdb/speaker'],
                                    'active' => (Yii::$app->controller->action->id === 'speaker')
                                ],
                                [
                                    'label' => Yii::t('app','Symposium'),
                                    'icon'=>'certificate',
                                    'url'=>['/wdb/symposium'],
                                    'active' => (Yii::$app->controller->id == 'wdb' && Yii::$app->controller->action->id == 'symposium')
                                ],
                                [
                                    'label' => Yii::t('app','IYF'),
                                    'icon'=>'certificate',
                                    'url'=>['/wdb/iyf'],
                                    'active' => (Yii::$app->controller->action->id === 'iyf')
                                ]
                            ],
                        ];

                        $menuSidebar[] = [
                            'label' => 'Local',
                            'icon' => 'paperclip',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Invited'),
                                    'icon'=>'certificate',
                                    'url'=>['/local/invited'],
                                    'active' => $this->context->route == 'local/invited'
                                    
                                ],
                                [
                                    'label' => Yii::t('app','Public'),
                                    'icon'=>'certificate',
                                    'url'=>['/local/public'],
                                    'active' => $this->context->route == 'local/public'
                                   
                                ]
                            ],
                        ];

                        $menuSidebar[] = [
                            'label' => 'International',
                            'icon' => 'paperclip',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Invited'),
                                    'icon'=>'certificate',
                                    'url'=>['/international/invited'],
                                    'active' => $this->context->route == 'international/invited'
                                ],
                                [
                                    'label' => Yii::t('app','Public'),
                                    'icon'=>'certificate',
                                    'url'=>['/international/public'],
                                    'active' => $this->context->route == 'international/public'
                                ]
                            ],
                        ];

                        $menuSidebar[] = [
                            'label' => 'Committee',
                            'icon' => 'paperclip',
                            'items' => [
                                [
                                    'label' => Yii::t('app','PT Ghani'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/ghani'],
                                    'active' => (Yii::$app->controller->action->id === 'ghani')
                                ],
                                [
                                    'label' => Yii::t('app','PT Dyandra'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/dyandra'],
                                    'active' => (Yii::$app->controller->action->id === 'dyandra')
                                ],
                                [
                                    'label' => Yii::t('app','Panitia Kemdikbud'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/kemdikbud'],
                                    'active' => (Yii::$app->controller->action->id === 'kemdikbud')
                                ],
                                [
                                    'label' => Yii::t('app','Panitia Protokol'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/protokol'],
                                    'active' => (Yii::$app->controller->action->id === 'protokol')
                                ],
                                [
                                    'label' => Yii::t('app','Panitia FIDAF'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/fidaf'],
                                    'active' => (Yii::$app->controller->action->id === 'fidaf')
                                ],
                                [
                                    'label' => Yii::t('app','Panitia Pengarah'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/pengarah'],
                                    'active' => (Yii::$app->controller->action->id === 'pengarah')
                                ],
                                [
                                    'label' => Yii::t('app','Panitia Persidangan'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/persidangan'],
                                    'active' => (Yii::$app->controller->action->id === 'persidangan')
                                ],
                                [
                                    'label' => Yii::t('app','Technical Support'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/technicalsupport'],
                                    'active' => (Yii::$app->controller->action->id === 'technicalsupport')
                                ],
                                [
                                    'label' => Yii::t('app','Medical Team'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/medical'],
                                    'active' => (Yii::$app->controller->action->id === 'medical')
                                ],
                                [
                                    'label' => Yii::t('app','Exhibition'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/exhibition'],
                                    'active' => (Yii::$app->controller->action->id === 'exhibition')
                                ],

                                [
                                    'label' => Yii::t('app','Liaison Officer'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/liaison-officer'],
                                    'active' => (Yii::$app->controller->action->id === 'liaison-officer')
                                ],

                                [
                                    'label' => Yii::t('app','Int.Youth Forum Production'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/iyf-production'],
                                    'active' => (Yii::$app->controller->action->id === 'iyf-production')
                                ],
                                [
                                    'label' => Yii::t('app','All Committe'),
                                    'icon'=>'certificate',
                                    'url'=>['/committee/all-committie'],
                                    'active' => (Yii::$app->controller->action->id === 'all-committie')
                                ],
                                
                                
                                

                            ],
                        ];
                        $menuSidebar[] = [
                                
                            'label' => Yii::t('app','Media'),
                            'icon'=>'facetime-video',
                            'url'=>['/committee/media'],
                            'active' => (Yii::$app->controller->action->id === 'media')
                                
                        ];  



                        $menuSidebar[] = [
                            'label' => 'Master Data',
                            'icon' => 'th',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Category Participant'),
                                    'url'=>['/masterdatavariety/index'],
                                    'active' => (Yii::$app->controller->id === 'masterdatavariety')
                                ],
                                [
                                    'label' => Yii::t('app','Group Variety participant'),
                                    'url'=>['/masterdatagroup/index'],
                                    'active' => (Yii::$app->controller->id === 'masterdatagroup')
                                ],
                                [
                                    'label' => Yii::t('app','Attend'),
                                    'url'=>['/masterdataattend/index'],
                                    'active' => (Yii::$app->controller->id === 'masterdataattend')
                                ],
                                [
                                    'label' => Yii::t('app','Symposium'),
                                    'url'=>['/masterdatasymposium/index'],
                                    'active' => (Yii::$app->controller->id === 'masterdatasymposium')
                                ],
                                [
                                    'label' => Yii::t('app','Country'),
                                    'url'=>['/masterdatacountry/index'],
                                    'active' => (Yii::$app->controller->id === 'masterdatacountry')
                                ],
                            ],
                        ];
                        
                        $menuSidebar[] = [
                            'label' => 'Export',
                            'icon' => 'export',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Data WDB'),
                                    'items' => [
                                        [
                                            'label' => Yii::t('app','Speaker'),
                                            'url'=>['/export/export-wdb-speaker'],
                                            'active' => (Yii::$app->controller->action->id === 'export-wdb-speaker')
                                        ],
                                        [
                                            'label' => Yii::t('app','Symposium'),
                                            'url'=>['/export/export-wdb-symposium'],
                                            'active' => (Yii::$app->controller->action->id === 'export-wdb-symposium')
                                        ],
                                        [
                                            'label' => Yii::t('app','Iyf'),
                                            'url'=>['/export/export-wdb-iyf'],
                                            'active' => (Yii::$app->controller->action->id === 'export-wdb-iyf')
                                        ]
                                    ],
                                ],
                                [
                                    'label' => Yii::t('app','Data Local Participant'),
                                    'items' => [
                                        [
                                            'label' => Yii::t('app','Invited'),
                                            'url'=>['/export/export-local-invited'],
                                            'active' => (Yii::$app->controller->action->id === 'export-local-invited')
                                        ],
                                        [
                                            'label' => Yii::t('app','Public'),
                                            'url'=>['/export/export-local-public'],
                                            'active' => (Yii::$app->controller->action->id === 'export-local-public')
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('app','Data International Participant'),
                                    'items' => [
                                        [
                                            'label' => Yii::t('app','Invited'),
                                            'url'=>['/export/export-international-invited'],
                                            'active' => (Yii::$app->controller->action->id === 'export-international-invited')
                                        ],
                                        [
                                            'label' => Yii::t('app','Public'),
                                            'url'=>['/export/export-international-public'],
                                            'active' => (Yii::$app->controller->action->id === 'export-international-public')
                                        ],
                                    ],
                                ]
                            ],
                        ];

                        $menuSidebar[] = [
                            'label' => 'Selection of public participation',
                            'icon' => 'ok',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Local'),
                                    'url'=>['/seleksi/local'],
                                    'active' => $this->context->route == 'seleksi/local'
                                ],
                                [
                                    'label' => Yii::t('app','International'),
                                    'url'=>['/seleksi/international'],
                                    'active' => $this->context->route == 'seleksi/international'
                                ]
                            ],
                        ];

                        $menuSidebar[] = [
                            'label' => Yii::t('app','Statistik'),
                            'url' => ['/statistik/index'],
                            'icon' => 'signal',
                            'active' => (Yii::$app->controller->id === 'statistik')
                        ];

                        $menuSidebar[] = [
                            'label' => Yii::t('app','Peta'),
                            'url' => ['/peta/index'],
                            'icon' => 'map-marker',
                            'active' => (Yii::$app->controller->id === 'peta')
                        ];

                        $menuSidebar[] = [
                            'url' => ['/user/admin'],
                            'label' => Yii::t('app','User'),
                            'icon' => 'user',
                            'active' => (Yii::$app->controller->id === 'admin' || Yii::$app->controller->id === 'id')
                        ];

                        $menuSidebar[] = [
                            'label' => 'RBAC',
                            'icon' => 'transfer',
                            'items' => [
                                [
                                    'label' => Yii::t('app','Assignment'),
                                    'icon'=>'hand-right',
                                    'url'=>['/admin/assignment'],
                                    'active' => (Yii::$app->controller->id === 'assignment')
                                ],
                                [
                                    'label' => Yii::t('app','Role'),
                                    'icon'=>'pushpin',
                                    'url'=>['/admin/role'],
                                    'active' => (Yii::$app->controller->id === 'role')
                                ],
                                [
                                    'label' => Yii::t('app','Permission'),
                                    'icon'=>'bookmark',
                                    'url'=>['/admin/permission'],
                                    'active' => (Yii::$app->controller->id === 'permission')
                                ],
                                [
                                    'label' => Yii::t('app','Rute'),
                                    'icon'=>'share-alt',
                                    'url'=>['/admin/route'],
                                    'active' => (Yii::$app->controller->id === 'route')
                                ],
                                [
                                    'label' => Yii::t('app','Rules'),
                                    'icon'=>'tasks',
                                    'url'=>['/admin/rule'],
                                    'active' => (Yii::$app->controller->id === 'rule')
                                ],

                                // [
                                //     'label' => Yii::t('app','Menu'),
                                //     'icon'=>'menu-hamburger',
                                //     'url'=>['/admin/menu'],
                                //     'active' => (Yii::$app->controller->id === 'menu')
                                // ],
                            ],
                        ];

                        $menuSidebar = Helper::filter($menuSidebar);
                        echo SideNav::widget([
                            'type' => SideNav::TYPE_DEFAULT,
                            'encodeLabels' => false,
                            'heading' => Yii::t('app',''),
                            'items' => $menuSidebar
                        ]);
                    }
                    ?>
                </div>
    
                <div class="col-lg-9 col-md-12 col-xs-12">
                    <?= $content ?>
                </div>
            </div>
        <?php } else { ?>
            <?= $content ?>
        <?php } ?>

    </div>
</div>

<div class="modal fade" id="tentang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tentang</h4>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="kontak" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kontak</h4>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
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

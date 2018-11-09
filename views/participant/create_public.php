<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Participant */

$this->title = 'Public Register';
$this->params['breadcrumbs'][] = ['label' => 'Participant'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-create">

    <?= $this->render('_form_public', [
        'model' => $model,
        'user'	=> $user,
    ]) ?>

</div>

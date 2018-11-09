<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Participant */

$this->title = 'Create Participant';
$this->params['breadcrumbs'][] = ['label' => 'Participant', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

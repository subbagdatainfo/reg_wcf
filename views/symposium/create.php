<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Symposium */

$this->title = 'Create Symposium';
$this->params['breadcrumbs'][] = ['label' => 'Symposia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symposium-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

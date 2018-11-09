<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Attend */

$this->title = 'Create Attend';
$this->params['breadcrumbs'][] = ['label' => 'Attends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

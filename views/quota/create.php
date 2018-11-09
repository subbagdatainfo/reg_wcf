<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Varietypartisipant */

$this->title = 'Create Varietypartisipant';
$this->params['breadcrumbs'][] = ['label' => 'Varietypartisipants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varietypartisipant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

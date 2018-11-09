<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Companion */

$this->title = 'Create Companion';
$this->params['breadcrumbs'][] = ['label' => 'Companions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

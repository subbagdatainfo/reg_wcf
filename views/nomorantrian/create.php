<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nomorantrian */

$this->title = Yii::t('app', 'Create Nomorantrian');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nomorantrians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomorantrian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Antrian */

$this->title = Yii::t('app', 'Create Antrian');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Antrians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="antrian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Loket */

$this->title = Yii::t('app', 'Create Loket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lokets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

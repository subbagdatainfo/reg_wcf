<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Symposiumguestbook */

$this->title = Yii::t('app', 'Create Symposiumguestbook');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Symposiumguestbooks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symposiumguestbook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

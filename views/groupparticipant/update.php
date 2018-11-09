<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Groupvarietyparticipant */

$this->title = 'Update Groupvarietyparticipant: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Groupvarietyparticipants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="groupvarietyparticipant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

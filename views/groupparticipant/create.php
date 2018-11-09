<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Groupvarietyparticipant */

$this->title = 'Create Groupvarietyparticipant';
$this->params['breadcrumbs'][] = ['label' => 'Groupvarietyparticipants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupvarietyparticipant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Companion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Companions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'invitation_code',
            'token',
            'title',
            'full_name',
            'user_photo',
            'name_on_badge',
            'address',
            'gender',
            'date_of_birth',
            'country_id',
            'nationality',
            'pasport_ktp_number',
            'place_of_issue',
            'start_date',
            'end_date',
            'phone',
            'fax',
            'email:email',
            'partisipant:boolean',
            'category',
            'organization',
            'speaker:boolean',
            'abstract',
            'file_presentation',
            'full_paper',
            'photo',
            'participant_status',
            'variety_id',
            'dietary_id',
            'symposium_day_one_id',
            'symposium_day_two_id',
            'date_arrival',
            'time_arrival',
            'flight_number_arrival',
            'eta',
            'date_departure',
            'time_departure',
            'flight_number_departure',
            'etd',
            'start_date_attend',
            'end_date_attend',
            'visit_subak_bali:boolean',
            'cultural_visit:boolean',
            'attend_id',
            'is_delete:boolean',
            'invitation_sent:boolean',
            'provinsi_id',
            'user_id',
            'handphone',
            'tell_us:ntext',
            'candidate_chosen:ntext',
            'essay',
            'tittle',
            'author',
            'content:ntext',
            'room_type_id',
            'room_type_approve:boolean',
            'transportation',
            'ktp_pasport',
            'submit:boolean',
            'is_representative:boolean',
            'dietary_specify',
            'is_companion:boolean',
            'is_companion_valid:boolean',
            'is_companion_from',
        ],
    ]) ?>

</div>

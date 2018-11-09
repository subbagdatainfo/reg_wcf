<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$title = 'Representative Status';
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if ($status) { ;?>
	<div class="alert alert-success alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
		<strong>Your request representative has approved.</strong> 
	</div>
<?php }else{ ;?>
	<div class="alert alert-success alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
		<strong>Your request representative is waiting for approval.</strong> 
	</div>
<?php };?>
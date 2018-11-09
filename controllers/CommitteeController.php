<?php

namespace app\controllers;

use Yii;
use app\models\Participant;
use app\models\ParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Varietypartisipant;
use kartik\mpdf\Pdf;

class CommitteeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'dashboard';
        return $this->render('index');
    }

    public function actionWcf()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('wcf', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWcfview($id)
    {
        $this->layout = 'dashboard';
        return $this->render('wcfview', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionWcfupdate()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('wcfupdate', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWcfdelete()
    {
        $this->layout = 'dashboard';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionKesenian()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('kesenian', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKesenianview($id)
    {
        $this->layout = 'dashboard';
        return $this->render('kesenianview', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionWKesenianupdate()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('wcfupdate', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWKeseniandelete()
    {
        $this->layout = 'dashboard';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionWdb()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('wdb', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWdbview($id)
    {
        $this->layout = 'dashboard';
        return $this->render('wdbview', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionWdbupdate()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('wdbupdate', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWdbdelete()
    {
        $this->layout = 'dashboard';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGhani(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchGhani(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionDyandra(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchDyandra(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionKemdikbud(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchKemdikbud(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionProtokol(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchProtokol(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionFidaf(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchFidaf(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionPengarah(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchPengarah(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionPersidangan(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchPersidangan(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionTechnicalsupport(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchTechnicalsupport(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionMedia(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchMedia(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionAllCommittie(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchCommittie(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionMedical(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchMedical(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionExhibition(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchExhibition(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionLiaisonOfficer(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchLiaisonofficer(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionIyfProduction(){

        $this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchIyfporudction(Yii::$app->request->queryParams);

        return $this->render('commiitte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionBadge($id)
    {
        $model = $this->findModel($id);

        $model->updateCounters(['counter' => 1]);
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => [62, 100],
            // portrait orientation
            // 'orientation' => Pdf::ORIENT_PORTRAIT, 
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,

            'marginLeft'    => 0,
            'marginRight'   => 0,
            'marginTop'     => 0,
            'marginBottom'  => 0,
            'marginHeader'  => 0,
            'marginFooter'  => 0,

            // your html content input
            'content' =>  $this->renderPartial('badge', ['model' => $model]),
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssFile' => '@webroot/css/bootstrap.css',
            // 'cssFile' => '@webroot/css/site.css',
            // any css to be embedded if required
            // 'cssInline' => '.tg  {border-collapse:collapse;border-spacing:0;} .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg .tg-yw4l{vertical-align:top}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Badge World Culture Forum 2016'],
             // call mPDF methods on the fly
            'methods' => [ 
                //'SetHeader'=>['Date print : '.date("Y/m/d H:i:s")], 
                //'SetFooter'=>['Badge World Culture Forum 2016 for ' . $model->full_name],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

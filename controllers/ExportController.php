<?php

namespace app\controllers;

use Yii;
use app\models\Participant;
use app\models\ParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ExportController extends \yii\web\Controller
{
    public function actionExportwdb()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchExportwdb(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportWdbSpeaker()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchSpeaker(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportWdbSymposium()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchSymposium(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportWdbIyf()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchIyf(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportlocal()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchExportlocal(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportLocalInvited()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchInvited(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportLocalPublic()
    {
        $this->layout   = 'dashboard';
        
        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchPublic(Yii::$app->request->queryParams);

        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportinternational()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchExportinternational(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionExportInternationalInvited()
    {
        $this->layout   = 'dashboard';
        
        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchInternationalinvited(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportInternationalPublic()
    {
        $this->layout   = 'dashboard';
        
        $searchModel    = new ParticipantSearch();
        $dataProvider   = $searchModel->searchInternationalpublic(Yii::$app->request->queryParams);

        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}

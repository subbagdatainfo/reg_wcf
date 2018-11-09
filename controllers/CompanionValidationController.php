<?php

namespace app\controllers;

use Yii;
use app\models\Companion;
use app\models\CompanionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanionValidationController implements the CRUD actions for Companion model.
 */
class CompanionValidationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'approving' => ['POST'],
                    'disapproving' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Companion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';

        $searchModel = new CompanionSearch();
        $dataProvider = $searchModel->searchValidation(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'dashboard';

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Companion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'dashboard';

        $model = new Companion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Companion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'dashboard';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Companion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->request->post()) {
            print_r($_POST);
            die();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApproving($id)
    {
        $model = $this->findModel($id);
        $model->is_companion_valid = TRUE;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionDisapproving($id)
    {
        $model = $this->findModel($id);
        $model->is_companion_valid = FALSE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Companion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

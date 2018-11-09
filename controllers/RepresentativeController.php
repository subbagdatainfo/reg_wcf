<?php

namespace app\controllers;

use Yii;
use app\models\Representative;
use app\models\RepresentativeSearch;
use app\models\Participant;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepresentativeController implements the CRUD actions for Representative model.
 */
class RepresentativeController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Representative models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';

        $searchModel = new RepresentativeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Representative model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'dashboard';

        if (Yii::$app->request->post()) {
            // [Representative] => Array ( [approval] => 0 ) 

            $data = $this->findModel($id);
            $data->approval = $_POST["Representative"]["approval"];



            if ($_POST["Representative"]["approval"] == 1) {
                // TODO : After submit data for registration public Assign role "Invitation-User"
                $role_new = (object) ['name'=>'Invitation-User'];
                Yii::$app->authManager->assign($role_new,$data->user_id);
                
                // TODO : After add Assign so remove role "Invitation-User-Representative"
                $role_old = (object) ['name'=>'Invitation-User-Representative'];
                Yii::$app->authManager->revoke($role_old,$data->user_id);

                $data_participant                       = Participant::find()->where(['user_id' => $data->user_id])->one();
                $data_participant->full_name            = $data->name;
                $data_participant->room_type_id         = $data->room_type;
                $data_participant->is_representative    = TRUE;

                Yii::$app->mailer->compose()
                    ->setFrom('secretariat@worldcultureforum-bali.org')
                    ->setTo($data->user->email)
                    ->setSubject("Approval Request Representative")
                    ->setHtmlBody("Dear     " . $data->name . ",
                        </br>
                        </br>
                        </br>
                        <p>Thank you for confirming your participation in WCF 2016, it is our pleasure to inform you that you have been accepted as to attend the event as a  representative of Mr / Mrs " .$data->full_name.", Please note that WCF 2016 will still use the registrated email. </p>
                        <br/>
                        <br/>

                        <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                        <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                        <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                        <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                        <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                        <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org

                        <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p>

                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>



                        ")
                    ->send();

                $data_participant->save();
            }

            if ($data->save()) {

                return $this->redirect(['index']);
            }else{
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Representative model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Representative();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Representative model.
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
     * Deletes an existing Representative model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Representative model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Representative the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Representative::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\Antrian;
use app\models\Loket;
use app\models\Nomorantrian;
use app\models\AntrianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AntrianlController implements the CRUD actions for Antrian model.
 */
class AntrianController extends Controller
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
     * Lists all Antrian models.
     * @return mixed
     */
    public function actionIndex()
    {

        $this->layout = 'dashboard';
        $searchModel = new AntrianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Antrian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'dashboard';

        $jumlah_antrian_selesai             = Nomorantrian::find()->where(['status_antrian' => 3])->count();
        $jumlah_antrian_belum_selesai       = Nomorantrian::find()->where(['status_antrian' => 1])->count();

        return $this->render('view', [
            'model'                         => $this->findModel($id),
            'jumlah_antrian_selesai'        => $jumlah_antrian_selesai,
            'jumlah_antrian_belum_selesai'  => $jumlah_antrian_belum_selesai
        ]);
    }

    public function actionSelesai($id)
    {
        $this->layout = 'dashboard';
        
        $model = $this->findModel($id);
        $model_antrian = Nomorantrian::find()->where(['id'  => $model->nomor_antrian_id])->one();
        
        $model_antrian->status_antrian = 3;        
        date_default_timezone_set("Asia/Jakarta");
        $model_antrian->selesai_antri = date("Y-m-d H:i:s");
        $model_antrian->save();
        return $this->redirect(['index']);
    }

    public function actionLewati($id)
    {
        $this->layout = 'dashboard';
        
        $model = $this->findModel($id);
        $model_antrian = Nomorantrian::find()->where(['id'  => $model->nomor_antrian_id])->one();
        
        $model_antrian->status_antrian = 4;        
        date_default_timezone_set("Asia/Jakarta");
        $model_antrian->selesai_antri = date("Y-m-d H:i:s");
        $model_antrian->save();
        return $this->redirect(['index']);
    }

    /**
     * Creates a new Antrian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPanggil()
    {

        $this->layout = 'dashboard';

        
        $model = new Antrian();
      
        $nomor_antrian  = Nomorantrian::find()->where(['status_antrian' => 1])->orderBy(['nomor' => SORT_ASC])->one();
        $loket          = Loket::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['is_active' => TRUE])->orderBy(['id' => SORT_ASC])->one();

        if(empty($nomor_antrian)){
            \Yii::$app->getSession()->setFlash('error', 'Belum Ada Antrian..');
            return $this->redirect(Yii::$app->request->referrer);
        }elseif(empty($loket)){
            \Yii::$app->getSession()->setFlash('error_loket', 'Loket Belum tersedia..');
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            $model->nomor_antrian_id = $nomor_antrian->id;
            $model->loket_id         = $loket->id;
            $model->user_id          = $loket->user_id;
        
            if($model->save()){

                $model_antrian = Nomorantrian::findOne($model->nomor_antrian_id);

                $model_antrian->status_antrian = 2;

                if ($model_antrian->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                };

            }

        }

        
    }

    public function actionUlangiPanggilan($id)
    {
        $antrian = Antrian::findOne($id);

        return $this->redirect(Yii::$app->request->referrer);


    }
    
    /**
     * Updates an existing Antrian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Antrian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRealtime()
    {
        date_default_timezone_set('Asia/Brunei');

        $data_loket     = [];
        $loket          = Loket::find()->AsArray()->All();

        for ($i=0; $i < count($loket); $i++) { 
            $nomor_antrian = Nomorantrian::find()->where(["status_antrian"=>2])->AsArray()->All();
            if ($nomor_antrian) {
                for ($in=0; $in < count($nomor_antrian); $in++) { 
                    $antrian = Antrian::find()->where(["nomor_antrian_id"=>$nomor_antrian[$in]["id"]])->AsArray()->One();
                    if ($antrian) {
                        if ($antrian["loket_id"] == $loket[$i]["id"]) {
                            $data_nomor_antrian_sekarang = Nomorantrian::find()->where(["id"=>$antrian["nomor_antrian_id"]])->one();
                            $data_loket["nomor_antrian_id_loket_".$loket[$i]["id"]] = strtoupper($loket[$i]["nama_loket"]) . " = " . $data_nomor_antrian_sekarang->nomor;
                        // }else{
                        //     $data_loket["nomor_antrian_id_loket_".$loket[$i]["id"]] = strtoupper($loket[$i]["nama_loket"]) . " = -";
                        }
                    }else{
                        $data_loket["nomor_antrian_id_loket_".$loket[$i]["id"]] = strtoupper($loket[$i]["nama_loket"]) . " = -";
                    }
                }
            }else{
                $data_loket["nomor_antrian_id_loket_".$loket[$i]["id"]] = strtoupper($loket[$i]["nama_loket"]) . " = -";
            }
        }

        $antrian_next   = Nomorantrian::find()->where(['status_antrian'=>1])->orderBy(['id'=>SORT_ASC])->one();
        if ($antrian_next) {
            $next       = $antrian_next->nomor;
        }else{
            $next       = '-';
        }
        
        print_r(json_encode(["date"=>date('m/d/Y h:i:s a'),"loket"=>$data_loket,"next"=>$next]));
    }


    public function actionPengumuman()
    {
        $this->layout   = 'pengumuman';

        $loket          = Loket::find()->AsArray()->All();
        $antrian_next   = Nomorantrian::find()->where(['status_antrian'=>1])->orderBy(['id'=>SORT_ASC])->one();

        return $this->render('pengumuman',[
            'loket' => $loket,
            'antrian_next' => $antrian_next
        ]);
    }

    /**
     * Finds the Antrian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Antrian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Antrian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

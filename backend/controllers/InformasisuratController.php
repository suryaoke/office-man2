<?php

namespace backend\controllers;

use backend\models\Asalsurat;
use backend\models\Informasisurat;
use backend\models\InformasisuratSearch;
use backend\models\Isisurat;
use backend\models\Lampiransurat;
use backend\models\Log;
use backend\models\Naskahdinas;
use backend\models\Notif2;
use backend\models\Pembuatsurat;
use backend\models\Tandatangan;
use backend\models\Tembusansurat;
use backend\models\Tujuansurat;
use backend\models\User;
use backend\models\Verifikasi;
use GuzzleHttp\Psr7\InflateStream;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InformasisuratController implements the CRUD actions for Informasisurat model.
 */
class InformasisuratController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    // public function beforeAction($action)
    // {
    //     if ($action->id == 'acc-ttd') {
    //         $this->enableCsrfValidation = false;
    //     }

    //     return parent::beforeAction($action);
    // }
    /**
     * Lists all Informasisurat models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new InformasisuratSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $tujuan = Tujuansurat::find()->where(['id_user' => Yii::$app->user->identity->id])->all();
        $informasisurat = Informasisurat::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'informasisurat' => $informasisurat,
            'tujuan' => $tujuan,

        ]);
    }

    /**
     * Displays a single Informasisurat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Informasisurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Informasisurat();
        $asal = Asalsurat::find()->all();
        $naskah = Naskahdinas::find()->all();
        $update = Tujuansurat::find()->where(['id_informasi_surat' => $model->id])->one();
        $model1 = new Tandatangan();
        $model2 = new Pembuatsurat();
        $model3 = new Isisurat();
        $model4 = new Notif2();
        $model5 = new Verifikasi();
        $kondisi = "1";
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {


                $model->status = "dibaca";
                $model->save();
                $user = User::find()->where(['role' =>  Yii::$app->user->identity->role = "kepsek"])->one();
                $model1->id_informasi = $model->id;
                $model1->id_user = $user->id;
                $model1->status = "diperiksa";
                $model1->statusnotif = "belum dibaca";
                $model1->ket = "-";
                $model1->save();
                $model2->id_informasi = $model->id;
                $model2->id_user = Yii::$app->user->identity->id;
                $model2->tanggal =  date('Y-m-d H:i:s');
                $model2->save();
                $model3->id_informasi = $model->id;
                $data1 =  Naskahdinas::find()->where(['id' => $model['id_naskah_dinas']])->one();
                $model3->isi = $data1->body;
                $model3->save();
                $model4->id_sk = $model->id;
                $model4->created_at =  date('Y-m-d H:i:s');
                $model4->tujuan = $user->id;
                $model4->isi = $model->perihal;
                $model4->header = "Surat Baru";
                $model4->status = "belum dibaca";
                $model4->id_pengirim = Yii::$app->user->identity->id;
                $model4->save();
                $model5->id_informasi = $model->id;
                $model5->id_user = $user->id;
                $model5->status = "diperiksa";
                $model5->ket = "-";
                $model5->save();

                $log = new Log();
                $log->id_user =  Yii::$app->user->identity->id;
                $log->perihal = "Buat Surat Baru";
                $log->date = Date("d-m-Y ");
                $log->save();


                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [

            'model' => $model,
            'asal' =>  $asal,
            'naskah' => $naskah,
            'update' => $update,
            'model1' => $model1,
            'model2' => $model2,
            'model3' => $model3,
            'model4' => $model4,
            'model5' => $model5,
            'kondisi' => $kondisi
        ]);
    }

    /**
     * Updates an existing Informasisurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $asal = Asalsurat::find()->all();
        $naskah = Naskahdinas::find()->all();
        $update = Tujuansurat::find()->where(['id_informasi_surat' => $model->id])->one();
        $tanda = Tandatangan::find()->where(['id_informasi' => $model->id])->one();
        $kondisi = "2";
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'asal' => $asal,
            'naskah' => $naskah,
            'update' => $update,
            'tanda' => $tanda,
            'kondisi' => $kondisi
        ]);
    }


    /**
     * Deletes an existing Informasisurat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $id])->one();
        $isi = Isisurat::find()->where(['id_informasi' => $id])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $id])->one();
        $tandatangan = Tandatangan::find()->where(['id_informasi' => $id])->one();
        $notif = Notif2::find()->where(['id_pengirim' => $id])->one();
        $lampiran = Lampiransurat::find()->where(['id_informasi' => $id])->one();
        $tembusan = Tembusansurat::find()->where(['id_informasi' => $id])->one();
        $verifikasi = Verifikasi::find()->where(['id_informasi' => $id])->one();
        if ($tujuan  != null) {
            $tujuan->delete();
        }
        if ($isi  != null) {
            $isi->delete();
        }
        if ($pembuat  != null) {
            $pembuat->delete();
        }
        if ($tandatangan  != null) {
            $tandatangan->delete();
        }
        if ($notif  != null) {
            $notif->delete();
        }
        if ($lampiran  != null) {
            $lampiran->delete();
        }
        if ($tembusan  != null) {
            $tembusan->delete();
        }
        if ($verifikasi  != null) {
            $verifikasi->delete();
        }

       $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Hapus Surat Baru";
        $log->date = Date("d-m-Y ");
        $log->save(); 

        return $this->redirect(['index']);
    }

    /**
     * Finds the Informasisurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Informasisurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Informasisurat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTujuansurat($id)
    {
        $model0 = $this->findModel($id);
        $model = new Tujuansurat();
        $isi = Isisurat::find()->where(['id_informasi' => $model0->id])->one();

        $data = Informasisurat::find()->where(['id' => $model0->id])->one();
        $model1 = new Isisurat();
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model0->id])->all();

        $tanda = Tandatangan::find()->where(['id_informasi' => $model0->id])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $model0->id])->one();
     
        if ($model->load(Yii::$app->request->post())) {

            $model->save();

            $carisurat = Isisurat::find()->where(['id_informasi' => $model0->id])->one();
            if (strpos($carisurat->isi, '{tanggal_surat}')) {
                $isi = str_replace('{tanggal_surat}', $data->tanggal_surat, $carisurat->isi);
                $carisurat->isi = $isi;
                $carisurat->save();
            }
            if (strpos($carisurat->isi, '{no_surat}')) {
                $isi = str_replace('{no_surat}', $data->no_surat, $carisurat->isi);
                $carisurat->isi = $isi;
                $carisurat->save();
            }

            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Buat Tujuan Surat Baru";
            $log->date = Date("d-m-Y ");
            $log->save();




            return $this->redirect(['tujuansurat', 'id' => $model0->id]);
        }

        return $this->render('tujuansurat', [
            'model0' => $model0,
            'model' => $model,
            // 'data' => $data,
            'model1' => $model1,
            'tujuan' => $tujuan,
            'isi' =>  $isi,
            'tanda' => $tanda,
            'pembuat' => $pembuat,
         



        ]);
    }



    // public function actionAccTtd($id)
    // {
    //   $model=  Informasisurat::find()->where(['id' => $id])->one();
    //     if (Yii::$app->request->isPost) {

    //         $img = Yii::$app->request->post('img');
    //         $gambar =  '<img src=data:' . $img . ' style="width: 200px; height: 50px;">';

    //         $carisurat = Isisurat::find()->where(['id_informasi' => $model->id])->one();

    //         if (strpos($carisurat->isi, '{ttd}')) {
    //             // echo 'sobok';die;
    //             $isi = str_replace('{ttd}', $gambar, $carisurat->isi);
    //             $carisurat->isi = $isi;
    //             $carisurat->save(false);


    //             return $this->redirect(['tandatangan/update', 'id' => $model->id]);
    //         }}
    // }

    public function actionDelete2($del)
    {
        $query = Tujuansurat::findOne($del);

        $query->delete();
        $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Hapus Tujuan Surat Baru";
            $log->date = Date("d-m-Y ");
            $log->save();

        $data = Informasisurat::find()->where(['id' => $query->id_informasi_surat])->one();
        return $this->redirect(['tujuansurat', 'id' => $data->id]);
    }
}

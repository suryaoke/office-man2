<?php

namespace backend\controllers;

use backend\models\Informasisurat;
use backend\models\Pembuatsurat;
use backend\models\SignupForm;
use backend\models\Smdisposisi;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\Tandatangan;
use backend\models\Tujuansurat;
use backend\models\User;
use common\models\LoginForm;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],

                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function beforeAction($action)
    {


        if ($action->id == 'upload-ckeditor') {
            $this->enableCsrfValidation = false;
        }

        //return true;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $model = Smpenerima::find()->where(['id_penerima' => Yii::$app->user->identity->id]);
        $count = $model->count();
        $model1 = Smterkirim::find();
        $model2 = Pembuatsurat::find();
       
        $count1 = $model1->count();
        $count2 = $model2->count();
        
        $modeltujuan= Tujuansurat::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $modeltanda= Tandatangan::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $modelpembuat = Pembuatsurat::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        return $this->render('index', [
            'count' => $count,
            'count1' => $count1,
            'count2' => $count2,
            'modeltujuan' => $modeltujuan,
            'modelpembuat' => $modelpembuat,
            'modeltanda' => $modeltanda
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

            return $this->redirect(['site/user']);
        }

        return $this->render('signup', [
            'model' => $model,

        ]);
    }

    public function actionUser()
    {
        $model = new SignupForm();

        $user = User::find()->all();
        return $this->render('user', [
            'model' => $model,
            'user' => $user,

        ]);
    }

    public function actionDelete2($del)
    {
        $query = User::findOne($del);
        $query->delete();

        return $this->redirect(['site/user', 'id' => $query->id]);
    }

    public function actionUploadCkeditor()
    {
        if (isset($_FILES['upload']['name'])) {
            $file = $_FILES['upload']['tmp_name'];
            $file_name = $_FILES['upload']['name'];
            $file_name_array = explode(".", $file_name);
            $extension = end($file_name_array);
            $new_image_name = rand() . '.' . $extension;
            // chmod('upload', 0777);
            $allowed_extension = array("jpg", "gif", "png");
            if (in_array($extension, $allowed_extension)) {
                move_uploaded_file($file, 'upload/ckeditor_image/' . $new_image_name);
                $function_number = $_GET['CKEditorFuncNum'];
                $url = Url::toRoute(['/upload/ckeditor_image/' . $new_image_name]);
                $message = '';
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
            }
        } else {
            echo 'kosong';
        }
    }
}

<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\ChangePaswordForm;
use common\models\House;

use common\models\Messages;
use common\models\QuestionaireOfRoommate;
use common\models\User;
use common\models\UserInfo;
use DateTime;
use frontend\models\SearchHouseForm;
use frontend\models\SignupForm;
use frontend\models\UploadForm;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class MainController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main';
    public $defaultAction = 'login';
    public $postsInPage = 10;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['login', 'logout'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['login'],
                        'roles'   => ['?'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['logout'],
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error'            => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->layout = 'authorize';
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

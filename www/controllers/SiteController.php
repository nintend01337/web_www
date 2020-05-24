<?php

namespace app\controllers;

use app\models\LinkForm;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function debuger($content)
    {
        echo '<pre>';
        print_r($content);
        echo '</pre>'; die();
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        var_dump(Yii::$app->user->identity); die();
        return $this->render('index');
    }

    public  function actionSignup(){
        $model = new SignupForm();
        if (isset($_POST['SignupForm']))
        {
            $model ->attributes = Yii::$app->request->post('SignupForm');
            if ($model->validate() && $model->signup()){
                return $this->redirect('login');
            }
        }
        return $this ->render('signup',['model'=>$model]);
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
            $model = new LoginForm();
            if (Yii::$app->request->post('LoginForm'))
            {
                $model->attributes = Yii::$app->request->post('LoginForm');
                if ($model->validate())
                {
                 Yii::$app->user->login($model->getUser());
                 return $this->goHome();
//                 var_dump('Валидация успешна'); die();
                }
            }
            return $this->render('login',['model'=>$model]);
    }

    public function actionLink()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new LinkForm();
            if (isset($_POST['LinkForm'])) {
                $model->attributes = Yii::$app->request->post('LinkForm');
                    if ($model->validate() && $model->createLink())
                    {
                     $this->debuger($model);
                    }
            }
            return $this->render('link', ['model' => $model]);
        }
        else    return $this->actionLogin();
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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

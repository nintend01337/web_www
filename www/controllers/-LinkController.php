<?php


namespace app\controllers;


use app\models\LinkForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class LinkController extends Controller
{
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }

//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::class(),
//                'only' => ['*'],             // Имя превилегии  ?
//                'rules' => [
//                    [
//                        'actions' => ['links'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::class(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new LinkForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate() && $model->createLink()) {
                    // $this->debuger($model);
                    //    VarDumper::dump($model,10,true);
                }
            }
            return $this->render('link', compact('model'));
        } else
            return $this->redirect(['auth/login']);
    }
}


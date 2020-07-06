<?php


namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SignupForm;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    public function actionSignup()
    {
        $model = new SignupForm();
        /*//        if (isset($_POST['SignupForm']))
        //        {
        //            $model ->attributes = Yii::$app->request->post('SignupForm');
        //            if ($model->validate() && $model->signup()){
        //                return $this->redirect('login');
        //            }
        //        }
        //        if ($model->load(Yii::$app->request->post())) {
        //            $model->attributes = Yii::$app->request->post('SignupForm');
        //            if ($model->validate() && $model->signup())
        //                return $this->redirect('login');
        //        }*/
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['/site/index']); // redirect to Personal cabinet, not implemented
                }
            }
        }
        return $this->render('signup', compact('model'));
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

        //переделываем логин
        /*
        //            if (Yii::$app->request->post('LoginForm'))
        //            {
        //                $model->attributes = Yii::$app->request->post('LoginForm');
        //                if ($model->validate())
        //                {
        //                 Yii::$app->user->login($model->getUser());
        //                 return $this->goHome();
        //                }
        //            }
                // return $this->render('login',['model'=>$model]);

                //логин не работает так как сломалась валидация пароля
                //@ref  model/User.php / validatePassword()
        //        if ($model->load(Yii::$app->request->post())) {
        //            $model->attributes = Yii::$app->request->post('LoginForm');
        //            if ($model->validate()) {
        //                Yii::$app->user->login($model->getUser());
        //                return $this->goHome();
        //            }
        //        }*/
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', compact('model'));
    }
}
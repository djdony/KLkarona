<?php


namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use Yii;

class AuthController extends AdminController
{

    public $layout = 'main-login';

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/admin');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/admin');
        }

        /*   if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
               return $this->redirect('/admin');
           } */

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

        return $this->redirect('login');
    }


}
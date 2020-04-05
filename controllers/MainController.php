<?php

namespace app\controllers;

use app\models\Data;
use app\models\Profile;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use Yii;
use yii\web\Response;


class MainController extends Controller
{

    const NOTACTIVE = 0; // deleted profile
    const ACTIVE = 1; // active profile
    const VERIFIED = 2; // verified for support profile
    const NOTVERIFIED = 3; // not verified for suppport

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Data();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        $model = new Profile();

        // save profile ...
       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status_id = self::ACTIVE;
            $model->save();
            Yii::$app->session->setFlash('success', 'Data Validated');
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // View profile to edit
            return $this->render('profile', ['model' => $model]);
        }
    }
}

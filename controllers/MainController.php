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

    const NOTVERIFIED = 0; // new not verified profile
    const VERIFIED = 1; // verified profile for support
    const OTHERS = 2; // There can be as much statuses as needed.

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
            $model->status_id = self::NOTVERIFIED;
            $model->save();
            Yii::$app->session->setFlash('success', 'Data Validated');
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // View profile to edit
            return $this->render('profile', ['model' => $model]);
        }
    }
}

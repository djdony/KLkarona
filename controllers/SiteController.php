<?php

namespace app\controllers;

use app\models\Data;
use app\models\Profile;
use yii\web\Controller;
use Yii;


class SiteController extends Controller
{

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
            $model->save();
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // View profile to edit
            return $this->render('profile', ['model' => $model]);
        }
    }
}

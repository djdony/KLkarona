<?php

namespace app\controllers;

use app\models\Data;
use app\modules\admin\models\Profile;
use yii\web\Controller;
use Yii;


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
        // check data and verify it with Profile table...
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->idcard) {
            $profile = new Profile();

            // If entered idcard has record in data table then run action with attributes
            if (Data::getDataByIdcard($model->idcard))
            {
                Yii::$app->session->setFlash('success', 'Found Data');
                $data = Data::getDataByIdcard($model->idcard)->attributes;
                return $this->actionProfile($data);
            }
            //if data not found just new record without attributes.
            Yii::$app->session->setFlash('info', 'New Record');
            return $this->actionProfile();
        } else {
            //new data search page
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    public function actionProfile($data = [])
    {
        $model = new Profile();
        $model->setAttributes($data);

        // save profile...
       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status_id = self::NOTVERIFIED;
            $model->save();
            Yii::$app->session->setFlash('success', 'Data Validated');
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // New profile to edit
            return $this->render('profile', ['model' => $model]);
        }
    }
}

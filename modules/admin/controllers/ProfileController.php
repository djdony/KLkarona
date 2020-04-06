<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Profile;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            TimestampBehavior::class,
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {


        $user_regions = Yii::$app->user->identity->regions;
        $regions = [];
        foreach ($user_regions as $user_region) {
            array_push($regions, $user_region->id);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()->where([
                'region_id' => $regions,
                ])
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate()
    {
        $user_regions = Yii::$app->user->identity->regions;
        $regions = [];
        foreach ($user_regions as $user_region) {
            array_push($regions, $user_region->id);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find()->where([
                'region_id' => $regions,
            ])
        ]);
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);

        if (Yii::$app->request->post() && in_array($model->region_id, $regions) ) {
            $data = [
                'status_id' => 5 - strlen(Yii::$app->request->post('status_id')),
                'updated_by' => Yii::$app->user->getId()
            ];
            $model->setAttributes($data);
            $model->save();
            return "Status changed";
        }
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

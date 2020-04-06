<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Bank;
use app\modules\admin\models\LicenseType;
use app\modules\admin\models\Profile;
use app\modules\admin\models\Region;
use Yii;

class DefaultController extends AdminController
{

    /**
     * Displays Dashboard Panel.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Get regions of Autorized User
        $user_regions = Yii::$app->user->identity->regions;
        $regions = [];
        foreach ($user_regions as $user_region) {
            array_push($regions, $user_region->id);
        }

        /// Find total count of profiles with regions of user
        $profiles = Profile::find()->where([
            'region_id' => $regions
        ])->count();

        // Total counts of models in dashboard
        $regions = Region::find()->count();
        $license_types = LicenseType::find()->count();
        $banks = Bank::find()->count();

        return $this->render('index', compact([
            'profiles',
            'regions',
            'license_types',
            'banks',
        ]));
    }


}

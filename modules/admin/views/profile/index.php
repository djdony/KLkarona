<?php

use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;

$js = <<< JS
    function sendRequest(status_id, id){
        $.ajax({
            url:'/admin/profile/update',
            method:'post',
            data:{status_id:status_id,id:id},
            success:function(data){
                alert(data);
            },
            error:function(jqXhr,status_id,error){
                alert(error);
            }
        });
    }
JS;

$this->registerJs($js);
?>
<div class="profile-index">

  <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
            'name',
            'idcard',
            //'address',
            //'postcode',
            'region_id',
            //'phone',
            //'email:email',
            'license_no',
            'license_id',
            'bank_id',
            //'bank_account',
            //'bank_holder',
            //'sign_date',
            //'sign_name',
            //'sign_idcard',
            //'status_id',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    return SwitchInput::widget(
                        [
                            'name' => 'status_11',
                            'pluginEvents' => [
                                'switchChange.bootstrapSwitch' => "function(e){sendRequest(e.currentTarget.checked, $data->id);}"
                            ],

                            'pluginOptions' => [
                                'size' => 'mini',
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => 'Active',
                                'offText' => 'Inactive'
                            ],
                            'value' => $data->status_id
                        ]
                    );
                }
            ],
        ],
    ]); ?>


</div>

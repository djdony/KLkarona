<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Write your MyKad!</h1>


        <?php $form = ActiveForm::begin([
            'id' => 'data-form',
            'layout' => 'horizontal',
        ]); ?>
        <?= $form->field($model, 'idcard')->label(false) ?>
      <div class="form-group">


        <div class="col-lg-offset-1 col-lg-11">

            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'data']) ?>
        </div>
      </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="body-content">

        <div class="row">

        </div>

    </div>
</div>

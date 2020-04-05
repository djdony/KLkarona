<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Region;
use app\models\Bank;
use app\models\LicenseType;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */

// here used a lot php as i see.
// for me clean HTML looks prettier than YII widget format.

// that's OK. You can use some templating engine if you want.
?>

<div class="profile">

    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',

            ],
        ],
    ]); ?>
  <h1 class="redw">A. MAKLUMAT PEMOHON</h1>
  <div class="bg-warning">

    <div class="row"> <!-- what's columns grid? -->
        <?= $form->field($model, 'name', ['options' => ['class' => 'form-group col-md-8']])->label('Nama Pemohon') ?>
        <?= $form->field($model, 'phone', ['options' => ['class' => 'form-group col-md-4']])->label('No.Telefon') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'idcard', ['options' => ['class' => 'form-group col-md-8']])->label('No.Kad Pengenalan') ?>
        <?= $form->field($model, 'email', ['options' => ['class' => 'form-group col-md-4']])->label('Email') ?>

    </div>

    <div class="row">
        <?= $form->field($model, 'license_no', ['options' => ['class' => 'form-group col-md-8']])->label('No.Kad Pengenalan') ?>
        <?= $form->field($model, 'license_id', ['options' => ['class' => 'form-group col-md-4']])->dropDownList(
            ArrayHelper::map(LicenseType::find()->all(), 'id', 'title'),
            ['prompt' => 'Select Licence Type']
        )->label('Jenis Permiagan') ?>

    </div>
    <div class="row">
        <?= $form->field($model, 'address', ['options' => ['class' => 'form-group col-md-8']])->label('Alamat') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'region_id', ['options' => ['class' => 'form-group col-md-8']])->dropDownList(
            ArrayHelper::map(Region::find()->all(), 'id', 'title'),
            ['prompt' => 'Select Region']
        )->label('Pihak Tempatan') ?>
        <?= $form->field($model, 'postcode', ['options' => ['class' => 'form-group col-md-4']])->label('Poskod') ?>
    </div>

  </div>
  <h1 class="redw">B. MAKLUMAT BANK</h1>
  <div class="bg-warning">
    <div class="row">
        <?= $form->field($model, 'bank_id', ['options' => ['class' => 'form-group col-md-8']])->dropDownList(
            ArrayHelper::map(Bank::find()->all(), 'id', 'title'),
            ['prompt' => 'Select Bank']
        )->label('Nama Bank') ?>
        <?= $form->field($model, 'bank_account', ['options' => ['class' => 'form-group col-md-4']])->label('No. Akaun') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'bank_holder', ['options' => ['class' => 'form-group col-md-12']])->label('Nama Pemegang Akaun') ?>
    </div>
  </div>
  <div class="bg-warning">
    <h1 class="redw">C. SENARAI SEMAK DOKUNEN</h1>

    <h1 class="redw">D. MAKLUMAT PELANGGAN</h1>
    <div class="bg-warning">
        <?= $form->field($model, 'sign_name') ?>
        <?= $form->field($model, 'sign_idcard') ?>
        <?= $form->field($model, 'sign_date') ?>
      <div class="form-group">
        <div class="text-center">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
      </div>
    </div>
      <?php ActiveForm::end(); ?>

  </div><!-- profile -->


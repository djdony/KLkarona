<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?= $regions ?></h3>
        <p>Regions</p>
      </div>
      <div class="icon">
        <i class="fa fa-globe"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['region/index']) ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?= $banks ?></h3>
        <p>Banks</p>
      </div>
      <div class="icon">
        <i class="fa fa-university"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['bank/index']) ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?= $profiles ?></h3>
        <p>Profiles</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['profile/index']) ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue">
      <div class="inner">
        <h3><?= $license_types ?></h3>
        <p>License Types</p>
      </div>
      <div class="icon">
        <i class="fa fa-id-badge"></i>
      </div>
      <a href="<?= \yii\helpers\Url::to(['license-type/index']) ?>" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
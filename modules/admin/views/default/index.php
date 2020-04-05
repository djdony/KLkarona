<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Admin Panel';
?>
<div class="site-index">


  <div class="body-content">
    <table class="table">

        <?php foreach ($profiles as $profile): ?>
          <tr>
            <?php $form = ActiveForm::begin([
                'id' => 'activate-form',
                'action' => 'verify'
            ]); ?>

            <td><?= $profile->name ?></td>
 <td>

                <?= Html::submitButton('Verify', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
</td>

            <?php ActiveForm::end(); ?>




          </tr>
        <?php endforeach; ?>
    </table>


  </div>
</div>

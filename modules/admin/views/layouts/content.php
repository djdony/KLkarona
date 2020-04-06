<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
?>
<div class="content-wrapper">
    <section class="content-header">

            <h1>
                <?= $this->title ?>
            </h1>

        <?=
        Breadcrumbs::widget(
            [
                'homeLink' => ['label' => 'Home', 'url'=> '/admin'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>


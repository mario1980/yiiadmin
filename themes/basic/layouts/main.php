<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/assets/css/themes/style1/pink-blue.css" rel="stylesheet" type="text/css"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'themeforestAPK版本归档系统（VRS）',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse ',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/user/login', 'jump' => Yii::$app->request->url]] :
                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/user/logout', 'jump' => Yii::$app->request->url],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>

            </div>
        </div>

        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>

<?php

namespace app\modules\backend\controllers;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

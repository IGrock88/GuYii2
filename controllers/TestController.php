<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TestController extends Controller
{

    /**
     * Displays test homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        //$product = (new Product())->getSingleProduct();
        return $this->render('index', ['test' => \Yii::$app->test->getTestProperty()]);
    }


}

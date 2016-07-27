<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class EmptyController extends Controller{
    public $enableCsrfValidation = false;
    /**end界面**/
    public function actionEnd(){
        $session = Yii::$app->session;
        $session->open();
        $uname=$session->get("uname");
        if($uname =="" || $uname==false){
            return $this->render("empty");
        }
    }

}
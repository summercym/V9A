<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class IndexController extends Controller{
    public $layout='common.php';
    public $enableCsrfValidation = false;
    /**主页面**/
    public function actionIndex(){
        $session = Yii::$app->session;
        $session->open();
        $uname=$session->get("uname");
        if(empty($uname)){
            return $this->render("empty");
        }else{
            return $this->render("index");
        }

    }
    /**欢迎界面**/
    public function actionLayouts(){
        $session = Yii::$app->session;
        $session->open();
        $uname=$session->get("uname");
        if(empty($uname)){
            return $this->render("empty");
        }else{
            return $this->render("layouts");
        }
    }
    /**end界面**/
    public function actionEnd(){
        $session = Yii::$app->session;
        $session->open();
        $uname=$session->get("uname");
        if(empty($uname)){
            return $this->render("empty");
        }else{
            return $this->render("end");
        }
    }

}
<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class LoginController extends Controller{
    /**登陆显示界面**/
    public $enableCsrfValidation = false;
    public function actionLogin(){
        $request= \Yii::$app->request;
        $connection= Yii::$app->db;
        $re=$request->post();
        if(empty($re)){
            return $this->render("login");
        }else {
            $uname = $request->post("uname");
            $pwd = md5($request->post("pwd"));
            setcookie("uname",$uname);
            $arr = $connection->createCommand("select uname,pwd from user WHERE uname='$uname' AND pwd='$pwd'")->queryOne();
            if ($arr) {
                $sql = (new \yii\db\Query())->select('*')->
                from('user')->
                where('uname=:uname and pwd=:pwd', [':uname' => $uname, ':pwd' => $pwd])
                    ->one();
                if($sql){
                    echo "1";
                }
            } else {
                echo "0";
            }
        }

    }
    /**注册页面**/
    public function actionZhu(){
        $request= Yii::$app->request;
        $connection= \Yii::$app->db;
        $re=$request->post();
        if(empty($re)){
            return $this->render("register");
        }else{
            $uname=$request->post("uname");
            setcookie("uname",$uname);
            $pwd=md5($request->post("pwd"));
            $psw=md5($request->post("psw"));
            $connection->createCommand()->insert("user",['uname'=>$uname,'pwd'=>$pwd,'psw'=>$psw])->execute();
            return $this->redirect("index.php?r=login/login");
        }
    }
    /**退出登录**/
    public function actionOut(){
        setcookie('uname',"");
        return $this->redirect("index.php?r=login/login");
    }
}
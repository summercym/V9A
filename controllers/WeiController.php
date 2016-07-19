<?php
namespace app\controllers;
class WeiController extends \yii\web\Controller{
    public $enableCsrfValidation = false;
    public function actionUrl(){
        $sel=$_GET['st'];
        $connection = \Yii::$app->db;
        $command = $connection->createCommand("SELECT we_token,number_id FROM numbers WHERE we_st='$sel'");
        $post = $command->queryOne();
        $id=$post['number_id'];
        $token=$post['we_token'];
        include_once('we.php');
    }
}
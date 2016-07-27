<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/**数据编写者
 * summer
 **/

class PersonController extends Controller{
    public $enableCsrfValidation = false;
    /**openid添加**/
    public function actionShow(){
        $connection = \Yii::$app->db;
        //如果这个post查不出来，说明用户根本第一次使用，没有添加公众号，停止操作
        $command = $connection->createCommand("SELECT we_appid,we_appsecret FROM numbers WHERE status=1");
        $connection=Yii::$app->db;
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$command['we_appid']."&secret=".$command['we_appsecret'];
        $file=file_get_contents($url);
        $json=json_decode($file,true)['access_token'];
        //echo $json;die;
        define("ACCESS_TOKEN",$json);
        $next_openid="";
        $urls="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".ACCESS_TOKEN."&next_openid=".$next_openid;
        $appid_content=file_get_contents($urls);
        $appid_arr=json_decode($appid_content,true);
        $openids=$appid_arr['data']['openid'];
        foreach($openids as $openid){
            $info_url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".ACCESS_TOKEN."&openid={$openid}&lang=zh_CN";
            $info_content=file_get_contents($info_url);
            $info_json=json_decode($info_content,true);
            $nickname=$info_json['nickname'];
            $sex=$info_json['sex'];
            $province=$info_json['province'];
            $country=$info_json['country'];
            $headimgurl=$info_json['headimgurl'];
            $subscribe_time=$info_json['subscribe_time'];
            $connection->createCommand()->insert("person",['nickname'=>$nickname,'sex'=>$sex,'province'=>$province,'country'=>$country,'headimgurl'=>$headimgurl,'subscribe_time'=>$subscribe_time])->execute();
        }
        $this->redirect("index.php?r=person/add");
    }
    /**展示页面**/
    public function actionAdd(){
        $connection=Yii::$app->db;
        $arr=$connection->createCommand("select * from person")->queryAll();
        return $this->render("person",['arr'=>$arr]);
    }


}
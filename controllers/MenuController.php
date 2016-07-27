<?php
namespace app\controllers;
use yii\caching\MemCache;
use yii\web\Controller;
use yii;
class MenuController extends Controller{
    public $layout='common.php';
	public $enableCsrfValidation = false;

    public function actionIndex(){
        $session = Yii::$app->session;
        $session->open();
        $uname=$session->get("uname");
        if($uname =="" || $uname==false){
            $this->redirect("index.php?r=empty/end");
        }else{
            return $this->renderPartial("form");
        }

    }

    public function actionList(){
        return $this->renderPartial('list');
    }

	//接受json菜单字符串，请求微信服务器接口
	public function actionAddll(){
        $session = Yii::$app->session;
        $session->open();
		//接受前台的json串
		$jsons=$_POST['json'];
		//获取到当前操作的公众号的主键ID            
		$connection = \Yii::$app->db;
        $number_id=$session->get('number_id');
		//如果这个post查不出来，说明用户根本第一次使用，没有添加公众号，停止操作
		$command = $connection->createCommand("SELECT we_appid,we_appsecret FROM numbers WHERE number_id='$number_id'");

		//获取到用户正在操作中的we_AppID,p_AppSecret
		$post = $command->queryOne();
		//通过p_AppID,p_AppSecret去获取access_token
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$post[we_appid]&secret=$post[we_appsecret]";
		//我们的$arr是一个json字符串
		$json=file_get_contents($url);
		//我们将json字符串转换成数组
		$arr=json_decode($json,true)['access_token'];
        $session->set('access_token',$arr);
		//echo $arr;die;
		//如果这个数组中不是我们想要的数据，说明这个返回失败，接口调用失败，这里其实可以做的更加详细一点，不过为了省事，先简单的做
		if($arr==''){
				echo 2;
				exit;
		}
		//这个url是设置菜单的微信url
		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$arr;
		$data=$jsons;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);   
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'post');   
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);    
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);           
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
		$tmpInfo = curl_exec($ch);  
		curl_close($ch);
		var_dump($tmpInfo);  
	}
}
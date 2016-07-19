<?php
/**
  * wechat php test
  */

//define your token

error_reporting(E_ALL ^ E_NOTICE);
define("TOKEN", $token);
define("ID", $id);
include_once('../sql/abc.php');
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid($pdo);

class wechatCallbackapiTest
{
	public function valid($pdo)
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature($pdo)){
        	echo $echoStr;
            $this->responseMsg($pdo);
        	exit;
        }
    }

    public function responseMsg($pdo)
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
                $imgTpl=   "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";
                 $voice=  "<xml>
                           <ToUserName><![CDATA[%s]]></ToUserName>
                           <FromUserName><![CDATA[%s]]></FromUserName>
                           <CreateTime>%s</CreateTime>
                           <MsgType><![CDATA[%s]]></MsgType>
                           <MediaId><![CDATA[%s]]></MediaId>
                           <Format><![CDATA[%s]]></Format>
                           <MsgId>%s</MsgId>
                           </xml>";
                  $video= "<xml>
                           <ToUserName><![CDATA[%s]]></ToUserName>
                           <FromUserName><![CDATA[%s]]></FromUserName>
                           <CreateTime>%s</CreateTime>
                           <MsgType><![CDATA[%s]]></MsgType>
                           <MediaId><![CDATA[%s]]></MediaId>
                           <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                           <MsgId>%s</MsgId>
                           </xml>";
				if(!empty( $keyword )){
                    $re=$pdo->query("select message_content from message where message_this='$keyword' and number_id= ".ID)->fetchAll();
                    if($re){
                        $msgType = "text";
                        $contentStr = $re[0]["message_content"];
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }elseif($keyword=="summerhome"){
                        $msgType = "image";
                        $mediaID = "_Xx32GPclcLeatjchvPOnbAamibVJOPkt2k0g_RolxOd0-Qk6Ps0zxpMSygPRLto";
                        $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType, $mediaID);
                        echo $resultStr;
                    }else{
                        $url="http://www.tuling123.com/openapi/api?key=3c8a8d6a41c66243e68295b580b7e19c&info=".$keyword;
                        $html=file_get_contents($url);
                        //echo $html;
                        $arr=json_decode($html,true);
                        $msgType = "text";
                        $contentStr = $arr['text'];
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }
                }else{
                    $msgType = "text";
                    $contentStr = "欢迎关注SummerHome";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
    /**模拟post登陆**/
    function curlPost($url,$data,$method){
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
    function uploadImage(){
        $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=2cfa8f9e50e0f510ede9d12338a5f564&type=image";
        $data="";
        $method="POST";
        $file=curlPost($url,$data,$method);
        echo $file;
    }
}

?>
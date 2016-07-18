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
                $imgTpl=  "<xml>
                           <ToUserName><![CDATA[%s]]></ToUserName>
                           <FromUserName><![CDATA[%s]]></FromUserName>
                           <CreateTime>%s</CreateTime>
                           <MsgType><![CDATA[%s]]></MsgType>
                           <PicUrl><![CDATA[this is a url]]></PicUrl>
                           <MediaId><![CDATA[%s]]></MediaId>
                           <MsgId>%s</MsgId>
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
                    $msgType = "text";
                    $contentStr = $re[0]["message_content"];
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                    $msgType = "text";
                    $contentStr = "欢迎关注V9A";
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
}

?>
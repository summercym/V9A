<?php
namespace app\controllers;
use yii\web\Controller;
use yii\web\Cookie;
use yii;
use yii\web\Request;
use yii\data\Pagination;
use app\models\Numbers;

Class NumController extends Controller{
    public $layout='common.php';
    public $enableCsrfValidation = false;  //post验证
    //添加页面
    public function actionInsert(){
        $request = Yii::$app->request->method;
        $requests = Yii::$app->request;
        $connection = \Yii::$app->db;
        @$uname=$_COOKIE['uname'];
        if(empty($uname)){
           $this->redirect("index.php?r=index/index");
        }else{
            if($request!="POST"){
                return $this->render("insert");
            }else{
                $number_name=$requests->post('number_name');//公众号名称
                //print_r($number_name);
                $we_type=$requests->post('we_type');//公众号类型
                $we_appid=$requests->post('we_appid');//公众号appid
                $we_appsecret=$requests->post('we_appsecret');//公众号appid
                $we_num=$requests->post('we_num');//公众号名称
                $we_yuan=$requests->post('we_yuan');//公众号名称
                $we_token=md5(rand(1000,9999));
                //生成url参数值
                $urlget=$this->actionUget();
                //生成微信通信页面
                $url=substr('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],0,strpos('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'?'))."?r=wei/url&st=".$urlget;

                //进行单条的加入数据
                $arr=$connection->createCommand()->insert('numbers', [
                    'number_name' => $number_name,
                    'we_type' => $we_type,
                    'we_appid' => $we_appid,
                    'we_appsecret' => $we_appsecret,
                    'we_num' => $we_num,
                    'we_token'=>$we_token,
                    'we_url'=>$url,
                    'we_st'=>$urlget,
                    'we_yuan' => $we_yuan,
                ])->execute();
                if($arr){
                    return  $this->redirect("index.php?r=num/show");
                }

            }

        }

    }

    //生成URl随机给值
    public function actionUget($len=10, $chars=null){
        if (is_null($chars)){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000*(double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    //展示信息
    public function actionShow(){
        $session = Yii::$app->session;
        $session->open();
        $query = numbers::find();
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);
        $list = $query->orderBy('number_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $id=$session->get("number_id");
        return $this->render('show', [
            'list' => $list,
            'id'=>$id,
            'pagination' => $pagination,
        ]);
    }
    //删除
    public function actionDel(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id =  $request->get("id");
        $connection->createCommand()->delete('numbers', ['number_id'=>$id])->execute();
        return $this->redirect("index.php?r=num/show");
    }

    //切换
    public function actionQie(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id =  $request->get("id");
        //echo $id;die;
        //调用session
        $session = Yii::$app->session;
        $session->open();
        $session->set("number_id",$id);
        if($session->get("number_id")){
            $this->redirect("index.php?r=num/show");
        }else{
            $this->redirect("index.php?r=num/show");
        }
    }
    //修改
    public function actionUp(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id =  $request->get("id");
        $re=$connection->createCommand("SELECT * FROM numbers WHERE number_id=$id")->queryOne();
        //print_r($re);die;
        return $this->render("inserts",['arr'=>$re]);
    }

    public function actionUpdate(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $number_name=$request->post('number_name');//公众号名称
        //print_r($number_name);
        $we_type=$request->post('we_type');//公众号类型
        $we_appid=$request->post('we_appid');//公众号appid
        $we_appsecret=$request->post('we_appsecret');//公众号appid
        $we_num=$request->post('we_num');//公众号名称
        $we_yuan=$request->post('we_yuan');//公众号名称
        $connection->createCommand()->update('numbers', ['number_name'=>$number_name,'we_type'=>$we_type,'we_appid'=>$we_appid,'we_appsecret'=>$we_appsecret])->execute();
        return $this->redirect("index.php?r=num/show");
    }


}
<?php
/*********
@消息回复
 *=消息表(we_message)
 *message_id	message_title	message_img	message_content	message_this
 * 消息id      	消息标题	         图片消息	  文字消息	       关键字
 *责任编辑人
 * summer
 *************/
namespace app\controllers;
use yii\web\Controller;
use yii\web\Cookie;
use yii;
use yii\web\Request;
use yii\data\Pagination;
use app\models\Message;

Class MessageController extends Controller{
   public $layout='common.php';
    public $enableCsrfValidation = false;
    /*文字回复*/
    public function actionContent(){
        $request=Yii::$app->request;
        $re=$request->post();
        $connection= \Yii::$app->db;
        $session = Yii::$app->session;
        $session->open();
        if(empty($re)){
            $query = Message::find();
            $pagination = new Pagination([
                'defaultPageSize' => 3,
                'totalCount' => $query->count(),
            ]);
            $countries = $query->orderBy('message_id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            return $this->render('demo', [
                'arr' => $countries,
                'pagination' => $pagination,
            ]);
        }else{
            $number_id=$session->get('number_id');
            $message_title=$request->post("message_title");
            $message_this=$request->post("message_this");
            $message_content=$request->post("message_content");
            $connection->createCommand()->insert("message",['number_id'=>$number_id,'message_title'=>$message_title,'message_this'=>$message_this,'message_content'=>$message_content])->execute();
            return $this->redirect("index.php?r=message/show");
        }

    }
    /*文字展示*/
    public function actionShow(){
        $query = Message::find();
        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);
        $countries = $query->orderBy('message_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('demo', [
            'arr' => $countries,
            'pagination' => $pagination,
        ]);
    }
    //删除
    public function actionDel(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id =  $request->get("id");
        $connection->createCommand()->delete('message', ['message_id'=>$id])->execute();
        return $this->redirect("index.php?r=message/show");
    }
    //修改
    public function actionUp(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id=$request->get("id");
        $re=$connection->createCommand("SELECT * FROM message WHERE message_id=$id")->queryOne();
        return $this->render("upd",['re'=>$re]);
    }
    public function actionUpdate(){
        $request = Yii::$app->request;
        $connection = \Yii::$app->db;
        $id=$request->post("id");
        $message_title=$request->post('message_title');//公众号名称
        //print_r($number_name);
        $message_this=$request->post('message_this');//公众号类型
        $message_content=$request->post('message_content');//公众号appid
        $connection->createCommand()->update('message', ['message_title'=>$message_title,'message_this'=>$message_this,'message_content'=>$message_content],"message_id=$id")->execute();
        return $this->redirect("index.php?r=message/show");
    }

}
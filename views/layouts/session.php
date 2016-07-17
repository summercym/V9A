<?php
ini_set("session.save_handler","user");
/**
@session垃圾回收机制
 **/
//session.gc_probability = 1 分子
ini_set("session.gc_probability",1);
//session.gc_divisor = 1000 分母
ini_set("session.gc_divisor",2);
//session.gc_maxlifetime = 1440 垃圾回收时间，session有效期
$maxlifetime = ini_set("session.gc_maxlifetime",10);
//echo $maxlifetime;die;
// 设置用户自定义会话存储函数
session_set_save_handler( "open","close","read","write","destroy","gc" );

function close(){
    mysql_close();
}
function read($sess_id){
    $sql = "select session_data from `session` where session_id = '$sess_id'";
    $result = mysql_query($sql);
    if($rows = mysql_fetch_assoc($result)){
        return $rows['session_data']; }else{
        return '';

    }
}
function write($sess_id,$sess_data){
    $sql = "insert into `session` (session_id,session_data,session_time) values('$sess_id','$sess_data', now())
on duplicate key update session_data = '$sess_data' , session_time = now()
";  //这是为了gc()
    return mysql_query($sql);

}
function destroy($sess_id){
    echo __FUNCTION__;
    $sql = "delete from `session` where session_id = '$sess_id'";
    return mysql_query($sql);

}
function gc($maxlifetime){
    echo __FUNCTION__;
    $sql = "delete from `session` where now()-session_time > '$maxlifetime'";
    //print_r($sql);die;
    return mysql_query($sql);
}
header("content-type:text/html;charset=utf8");
session_start();
$_SESSION['name']='张三';
//echo session_id();
echo $_SESSION['name'];

?>
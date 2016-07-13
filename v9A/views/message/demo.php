<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<!--<h4 style="color: red">消息回复功能切换</h4>
<?php /*if($status==1){*/?>
    机器人
<?php /*}else{
*/?>
自动回复
--><?php /*}*/?>
<form action="index.php?r=message/content" method="post" style="margin-top: 40px">
    <h1 style="color: red"><span style="margin-right: 220px">添加规则</span> 规则展示</h1>
    <table style="float :left; margin-left: 20px;">
        <tr><td style="padding: 10px" > 添加规则名称</td><td> <input type="text" name="message_title"/></td></tr>
        <tr><td style="padding: 10px">触发关键字</td><td> <input type="text" name="message_this"/></td></tr>
        <tr><td style="padding: 10px">回复内容</td><td> <textarea name="message_content" cols="30" rows="5"></textarea></td></tr>
        <tr><td style="padding: 20px"></td> <td style="padding: 20px"><input type="submit" value="提交" class="btn btn-primary" name="ss" id="normal"></td><tr>
    </table>
</form>
<form style="float:left; margin-left: 20px;">
<table border="1" style="text-align: center; margin-top: 8px;" >
    <th style="padding: 15px"><h5>id</h5></th>
    <th style="padding: 15px"><h5>规则名称</h5></th>
    <th style="padding: 15px"><h5 style="text-align: center">回复内容</h5></th>
    <th style="padding: 15px"><h5>触发关键字</h5></th>
    <th style="padding: 15px"><h5>操作</h5></th>
    <?php foreach($arr as $k=>$v){?>
        <tr>
            <td style="padding: 10px"><?php echo $v['message_id']?></td>
            <td ><?php echo $v['message_title']?></td>
            <td ><?php echo $v['message_content']?></td>
            <td ><?php echo $v['message_this']?></td>
            <td><a href="index.php?r=message/del&id=<?php echo $v['message_id']?>">删除</a>
                || <a href="index.php?r=message/up&id=<?php echo $v['message_id']?>">修改</a>
        </tr>
    <?php } ?>
</table>
<center><?= LinkPager::widget(['pagination' => $pagination]) ?></center>
</form>
<script src="./jq.js"></script>
<script>
    function fun(){

    }
</script>
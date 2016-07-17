<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="index.php?r=message/update" method="post" style="margin-top: 40px">
<h1 style="color: red"><span style="margin-right: 220px">添加规则</span> 规则展示</h1>
<table style="float :left; margin-left: 20px;">
    <input type="hidden" name="id"value="<?php echo $re['message_id']?>"/>
    <tr><td style="padding: 10px" > 添加规则名称</td><td> <input type="text" name="message_title" value="<?php echo $re['message_title']?>"/></td></tr>
    <tr><td style="padding: 10px">触发关键字</td><td> <input type="text" name="message_this" value="<?php echo $re['message_this']?>"/></td></tr>
    <tr><td style="padding: 10px">回复内容</td><td> <textarea name="message_content" cols="30" rows="5"><?php echo $re['message_content']?></textarea></td></tr>
    <tr><td style="padding: 20px"></td> <td style="padding: 20px"><input type="submit" value="修改" class="btn btn-primary" name="ss" id="normal"></td><tr>
</table>
</form>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center">
    <th>名称</th>
    <th>性别</th>
    <th>地址</th>
    <th>头像</th>
    <?php foreach($arr as $k =>$v)?>
    <tr>
        <td><?php echo $v['nickname']?></td>
        <td>
           <?php if($v['sex']==1){?>
               <?php echo "男"?>
            <?php }else{?>
               <?php echo "女"?>
            <?php }
           ?>
        </td>
        <td><?php echo $v['province']?></td>
        <td><img src="<?php echo $v['headimgurl']?>"></td>
    </tr>
</table>



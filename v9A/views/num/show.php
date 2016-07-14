<div class="ibox-content p-xl">

    <div class="table-responsive m-t">
        <table class="table invoice-table">
            <thead>
            <tr>
                <th>名称</th>
                <th>类型</th>
                <th>appid</th>
                <th>appsecret</th>
                <th>token</th>
                <th >url</th>
                <th>操作</th>
            </tr>
            </thead>
            <?php foreach($list as  $k=>$v) {?>
                <tr class="gradeA">
                    <td><?php echo $v['number_name']?></td>
                    <td><?php echo $v['we_type']?></td>
                    <td><?php echo $v['we_appid']?></td>
                    <td ><?php echo $v['we_appsecret']?></td>
                    <td ><?php echo $v['we_token']?></td>
                    <td ><?php echo $v['we_url']?></td>
                    <td colspan="3"><a href="index.php?r=num/del&id=<?php echo $v['number_id']?>">删除</a>|<a href="index.php?r=num/up&id=<?php echo $v['number_id']?>">修改</a>|<a href="index.php?r=num/qie&id=<?php echo $v['number_id']?>">
                            <?php if($id==$v['number_id']){
                                echo "当前";
                            }else{
                                echo "切换";
                            }?>
                        </a></td>
                </tr>
            <?php }?>

        </table>
    </div>
</div>

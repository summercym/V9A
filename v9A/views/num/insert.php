<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <h2>Hello,<?php echo @$_COOKIE['uname']?></h2>
        <small>您可以添加您需要的公众号</small>
        <form action="index.php?r=num/insert" method="post">
        <ul class="list-group clear-list m-t">
            <li class="list-group-item">
                    <span class="pull-right">
                            <input type="text" name="number_name" placeholder="公众号名称"/>
                        </span>
                <span class="label label-primary">1</span>名称
            </li>
            <li class="list-group-item">
                    <span class="pull-right">
                        <select name="we_type">
                            <option value="微信公众平台" checked>微信公众平台</option>
                            <option value="易信公众平台">易信公众平台</option>
                        </select>
                        </span>
                <span class="label label-info">2</span>公众平台类型
            </li>
            <li class="list-group-item">
                    <span class="pull-right">
                             <input type="text" name="we_appid" placeholder="公众号appid"/>
                        </span>
                <span class="label label-primary">3</span>appid
            </li>
            <li class="list-group-item">
                    <span class="pull-right">
                            <input type="text" name="we_appsecret" placeholder="公众号secret"/>
                        </span>
                <span class="label label-default">4</span>secret
            </li>
            <li class="list-group-item">
                    <span class="pull-right">
                            <input type="text" name="we_num" placeholder="微信号"/>
                        </span>
                <span class="label label-primary">5</span>微信号
            </li>
            <li class="list-group-item">
                    <span class="pull-right">
                             <input type="text" name="we_yuan" placeholder="原始号"/>
                        </span>
                <span class="label label-info">6</span>原始号
            </li>
            <li style="list-style: none;">
                <span ><input type="submit" value="添加" /></span>

            </li>
        </ul>
        </form>
    </div>
</div>


<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\www\tp5\public/../application/index\view\index\index.html";i:1528280557;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="__STATIC__/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<style>
    li{float:left;list-style:none}
</style>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>响应式的表单集合</legend>
</fieldset>
<?php echo \think\Request::instance()->module(); ?>/<?php echo \think\Request::instance()->controller(); ?>/<?php echo \think\Request::instance()->action(); ?><br />
<?php echo \think\Config::get('default_module'); 
dump(\think\Request::instance()->param());
dump(\think\Config::get('default_module'));
if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo $vo['name']; ?>" lay-verify="title" autocomplete="off" placeholder="请输入用户名" class="layui-input" disabled="disabled">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password" lay-verify="pass" value="<?php echo $vo['password']; ?>" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <div class="layui-input-inline">
                    <input type="text" name="status"  autocomplete="off" value="<?php echo $vo['status']; ?>" class="layui-input" disabled="disabled">
                </div>
            </div>
        </div>
    </div>



    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">地址</label>
            <div class="layui-input-inline">
                <input type="tel" name="address"  autocomplete="off" placeholder="请输入地址" value="<?php echo $vo['address']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email" lay-verify="email" placeholder="请输入邮箱"  value="<?php echo $vo['email']; ?>" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">生日</label>
            <div class="layui-input-inline">
                <input type="text" name="birthday"  value="<?php echo $vo['birthday']; ?>" lay-verify="date" onclick="layui.laydate({elem: this})" autocomplete="off" placeholder="yyyy-mm-dd" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">增加时间</label>
            <div class="layui-input-inline">
                <input type="text" name="create_time"  value="<?php echo $vo['create_time']; ?>" lay-verify="date" onclick="layui.laydate({elem: this})" autocomplete="off" placeholder="yyyy-mm-dd" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">分数</label>
            <div class="layui-input-inline">
                <input type="text" name="score"  value="<?php echo $vo['score']; ?>"  autocomplete="off"  class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">年龄</label>
            <div class="layui-input-inline">
                <input type="text" name="age" value="<?php echo $vo['age']; ?>" autocomplete="off" placeholder="请输入年龄" class="layui-input">
            </div>
        </div>
    </div>
</div>
<div style="text-align: center;">
    <a href="<?php echo url('index/see',['id'=>$vo['id']]); ?>"><button class="layui-btn" >查看</button></a>
    <!--onclick="See(this)" 当前选择对象-->
<button name="delete" class="layui-btn layui-btn-danger" data-id="<?php echo $vo['id']; ?>" >删除</button>
<button class="layui-btn " name="prompt" >测试prompt</button>
<!--<button class="layui-btn layui-btn-normal" ><a href="<?php echo url('index/rollback',['id'=>$vo['id']]); ?>">恢复</a></button>-->
    <script>
        function See(data) {
            console.log(data);
            alert(data);
        }
    </script>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<?php echo $page; ?>
<form method="post" action="checkcode">
    <input name="yanzhengma" type="text" />
    <img src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?x='+Math.random();" />
    <input name="tijiao" type="submit" />
</form>
<div id="container" style="width: 600px;height:400px;float: left"></div>
<div id="container1" style="width: 600px;height:400px;float: left"></div>

    <!--<div class="layui-form-item">-->
    <!--<div class="layui-inline">-->
    <!--<label class="layui-form-label">多规则验证</label>-->
    <!--<div class="layui-input-inline">-->
    <!--<input type="text" name="number" lay-verify="required|number" autocomplete="off" class="layui-input">-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="layui-inline">-->
    <!--<label class="layui-form-label">验证日期</label>-->
    <!--<div class="layui-input-inline">-->
    <!--<input type="text" name="date" id="date" lay-verify="date" placeholder="yyyy-mm-dd" autocomplete="off" class="layui-input" onclick="layui.laydate({elem: this})">-->
    <!--</div>-->
    <!--</div>-->
    <!---->
    <!--<div class="layui-inline">-->
    <!--<label class="layui-form-label">验证链接</label>-->
    <!--<div class="layui-input-inline">-->
    <!--<input type="tel" name="url" lay-verify="url" autocomplete="off" class="layui-input">-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->

    <!--<div class="layui-form-item">-->
    <!--<label class="layui-form-label">验证身份证</label>-->
    <!--<div class="layui-input-block">-->
    <!--<input type="text" name="identity" lay-verify="identity" placeholder="" autocomplete="off" class="layui-input">-->
    <!--</div>-->
    <!--</div>-->

<script>
    var jumpUrl = {
        'chart'  : "<?php echo url('chart'); ?>",
        'delete' : "<?php echo url('index/delete'); ?>"
    }
</script>
<script src="/static/jquery-2.1.1.js"></script>
<script src="/static/layui/layui.js" charset="utf-8"></script>
<script src="/static/Highcharts-6.1.0/code/highcharts.js"></script>
<script src="/static/chart.js"></script>
<script src="__STATIC__/common.js"></script>
<script src="/static/index/index.js"></script>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){

    });

</script>

</body>
</html>
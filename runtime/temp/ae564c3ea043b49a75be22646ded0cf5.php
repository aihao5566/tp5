<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"D:\www\tp5\public/../application/index\view\index\add.html";i:1527933796;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="__STATIC__/layui/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>响应式的表单集合</legend>
</fieldset>
<?php echo \think\Request::instance()->controller(); ?>/<?php echo \think\Request::instance()->action(); ?>
<form class="layui-form" action="" method="post">


    <div class="layui-form-item">
        <label class="layui-form-label">搜索</label>
        <div class="layui-input-inline">

            <!--测试当前对象是否还保留着request对象的属性<?php echo \think\Request::instance()->param('name'); ?>-->
            <input type="text" class="layui-input" name="keyword" placeholder="搜索" value="<?php echo input('param.name',''); ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入用户名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-inline">
            <input type="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-inline">
            <input type="password" name="repassword" lay-verify="pass" placeholder="<?php echo \think\Request::instance()->get('id'); ?>" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">搜索选择框</label>
            <div class="layui-input-inline">
                <select name="status" lay-verify="required" lay-search="" onchange="">
                    <option value="">请选择状态</option>
                    <option value="1">正常</option>
                    <option value="-1">删除</option>
                    <option value="0">禁用</option>
                    <option value="2">待审核</option>

                </select>
            </div>
        </div>
    </div>


    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">地址</label>
            <div class="layui-input-inline">
                <input type="tel" name="address"  autocomplete="off" placeholder="请输入地址" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email"  placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">生日</label>
            <div class="layui-input-inline">
                <input type="text" name="birthday"   onclick="layui.laydate({elem: this})" autocomplete="off" placeholder="yyyy-mm-dd" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">年龄</label>
            <div class="layui-input-inline">
                <input type="text" name="age"  autocomplete="off" placeholder="请输入年龄" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">分数</label>
            <div class="layui-input-inline">
                <input type="text" name="score"  autocomplete="off" placeholder="请输入分数" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">自提点</label>
            <div class="layui-input-inline">
                <input type="text" name="pickup_name"  autocomplete="off" placeholder="请输入自提点" class="layui-input">
            </div>
        </div>
    </div>

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

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1" type="submit" >立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>


<script src="__STATIC__/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){

    });
</script>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\www\tp5\public/../application/admin\view\auth\admin\index.html";i:1544963775;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo lang('Group'); ?></title>
</head>
<body>
<a href="?lang=zh-cn">中文</a><a href="?lang=en">英文</a>
<!--这里的url不能使用admin/auth/admin/edit-->
<?php echo lang('Login time'); ?><a href="<?php echo url('admin/auth.admin/edit'); ?>">edit</a>
<script src="/static/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/static/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js"></script>
</body>
</html>
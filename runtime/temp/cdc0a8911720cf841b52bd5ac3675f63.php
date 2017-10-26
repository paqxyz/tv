<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\xampp\htdocs\tv\public/../application/index\view\login\index.html";i:1508816312;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="../admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="../admin/frame/static/css/style.css">
    <link rel="icon" href="../admin/frame/static/image/code.png">
</head>
<body class="login-body body">

<div class="login-box">
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <h3>直播后台登录系统</h3>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">账号：</label>
            <div class="layui-input-inline">
                <input type="text" name="username" class="layui-input" lay-verify="username" placeholder="账号" autocomplete="on" maxlength="20"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码：</label>

            <div class="layui-input-inline">
                <input type="password" name="password" class="layui-input" lay-verify="password" placeholder="密码" maxlength="20"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">验证码：</label>
            <div class="layui-input-inline">
                <input type="text" name="code" class="layui-input layui-input-inline" style="width:80px;float:left" lay-verify="code" placeholder="验证码"/>
                <img src="<?php echo captcha_src(); ?>" id="verify_img"  onclick="refreshVerify()" style="float:right">
            </div>
        </div>
        <div class="layui-form-item">
            <button type="reset" class="layui-btn layui-btn-danger btn-reset">重置</button>
            <button type="button" class="layui-btn btn-submit" lay-submit="" lay-filter="sub">立即登录</button>
        </div>
    </form>
</div>

<script>
    function refreshVerify() {
        var ts = Date.parse(new Date())/1000;
        var img = document.getElementById('verify_img');
        img.src = "/captcha?id="+ts;
    }
</script>
<script type="text/javascript" src="../admin/frame/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['form', 'layer'], function () {

        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

        // 验证
        form.verify({
            username: function (value) {
                if (value == "") {
                    return "请输入用户名";
                }
            },
            password: function (value) {
                if (value == "") {
                    return "请输入密码";
                }
            },
            code: function (value) {
                if (value == "") {
                    return "请输入验证码";
                }
            }
        });

        // 提交监听
        form.on('submit(sub)', function (data) {
            $.post('/index/login/login',data.field,function(res){
			console.log(data.field);
			if(res=='ok'){
				layer.msg('发布成功,审核成功！');
				setTimeout(function(){
					window.location.href="/";
				},1000)
			}else{
				layer.msg(res);
			}
		});
        });

        // you code ...
    })

</script>
</body>
</html>
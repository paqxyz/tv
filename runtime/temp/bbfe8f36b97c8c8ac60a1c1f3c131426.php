<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\xampp\htdocs\tv\public/../application/admin\view\config\index.html";i:1508900425;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>网站基础资料设置</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../frame/layui/css/layui.css">
    <link rel="stylesheet" href="../frame/static/css/style.css">
    <link rel="icon" href="../frame/static/image/code.png">
</head>
<body class="body">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>网站基础资料设置</legend>
</fieldset>

<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">网站标题</label>
        <div class="layui-input-block">
            <input type="text" name="sitename" value="<?php echo $config['sitename']; ?>" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">网站描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入网站描述" name="des" lay-verify="des" class="layui-textarea"><?php echo $config['des']; ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">网站关键词</label>
        <div class="layui-input-block">
            <input type="text" name="keywords" value="<?php echo $config['keywords']; ?>" lay-verify="keywords" autocomplete="off" placeholder="请输入网站关键词,多个关键词用英文逗号分隔" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">注册协议</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea layui-hide" name="agreement" lay-verify="agreement" id="LAY_demo_editor"><?php echo $config['agreement']; ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" id="sendbtn" lay-submit="" lay-filter="config">保存设置</button>
        </div>
    </div>
</form>

<script src="../frame/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate;


        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length < 1){
                    return '请填写网站标题';
                }
            }
            ,des: function(value){
                if(value.length < 1){
                    return '网站描述不能为空';
                }
            }
            ,content: function(value){
                layedit.sync(editIndex);
            }
        });
        //监听提交
        $('#sendbtn').click(function(){
            form.on('submit(config)', function(data){
                console.log(data.field);
                $.ajax({
                    url: '/admin/config/save',
                    type: 'post',
                    dataType: 'json',
                    data: data.field,
                    success:function (res) {
                        if (res.code == 0) {
                            layer.msg(res.msg);
                            setTimeout(function(){window.location.reload();},1200);
                        } else {
                            layer.msg(res.msg)
                        }
                    }
                })
                return false;
            });
        })


    });
</script>
</body>
</html>
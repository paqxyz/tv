<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\xampp\htdocs\tv\public/../application/admin\view\live\add.html";i:1508980981;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>发布新的直播</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/admin/frame/static/css/style.css">
    <link rel="icon" href="/admin/frame/static/image/code.png">
</head>
<body class="body">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>发布新的直播</legend>
</fieldset>

<form class="layui-form">
    <input type="hidden" name="id" value="<?php echo (isset($id) && ($id !== '')?$id:''); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">选择分类</label>

        <div class="layui-input-inline">
            <select name="catid" lay-filter="catid">
                <option value="">请选择</option>
                <option value="1">教育</option>
                <option value="2">娱乐</option>
                <option value="3">会议</option>
                <option value="4">展会</option>
                <option value="5">其他</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">直播标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">直播描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入直播描述" name="dsp" lay-verify="dsp" class="layui-textarea"><?php echo (isset($info['dsp']) && ($info['dsp'] !== '')?$info['dsp']:''); ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">主播姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="author" value="<?php echo (isset($info['author']) && ($info['author'] !== '')?$info['author']:''); ?>" lay-verify="author" autocomplete="off" placeholder="请输入主播姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">缩略图</label>
        <div class="layui-input-block">
            <input type="hidden" name="thumb" value="" class="layui-input layui-input-inline" id="thumb">
            <button type="button" class="layui-btn" id="test1">
                <i class="layui-icon">&#xe67c;</i>上传主播封面
            </button>
            <div class="layui-upload-list" id="preview" >
                <img src="<?php echo (isset($info['thumb']) && ($info['thumb'] !== '')?$info['thumb']:''); ?>" class="layui-upload-img" width="200px">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">直播日期</label>
            <div class="layui-input-inline">
                <input type="text" name="stime" id="date" value="<?php echo (isset($info['stime']) && ($info['stime'] !== '')?$info['stime']:''); ?>" placeholder="请填写开播时间" autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">直播内容</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"><?php echo (isset($info['content']) && ($info['content'] !== '')?$info['content']:''); ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" id="sendbtn" lay-submit="" lay-filter="add">保存设置</button>
        </div>
    </div>
</form>

<script src="/admin/frame/layui/layui.js" charset="utf-8"></script>
<script>
layui.use(['form', 'layedit', 'laydate', 'upload'], function(){
    var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit
            ,laydate = layui.laydate
            ,upload = layui.upload;

    //执行实例
    var uploadInst = upload.render({
        elem: '#test1' //绑定元素
        ,url: '/index/upload/uploadThumb' //上传接口
        ,done: function(res){
            if (res.code == 0) {
                $('#thumb').val(res.filename);
                $('#preview').html('<img src="'+res.filename+'" class="layui-upload-img" width="200px">');
                layer.msg(res.msg);
            } else {                   
                layer.msg(res.msg);
            }
        }
        ,error: function(){
        //请求异常回调
        }
    });


    //日期
    laydate.render({
        elem: '#date',
        format: 'yyyy-MM-dd HH:mm:ss',
        type: 'datetime'
    });
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
        form.on('submit(add)', function(data){
            console.log(data.field);
            $.ajax({
                url: '/admin/live/save',
                type: 'post',
                dataType: 'json',
                data: data.field,
                success:function (res) {
                    if (res.code == 0) {
                        layer.msg(res.msg);
                        setTimeout(function(){window.location.href='/admin/live/index';},1200);
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
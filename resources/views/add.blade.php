<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>新增</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="stylesheet" href="{{ URL::asset('/layui/css/font.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/layui/css/xadmin.css') }}">
    <script src="{{ URL::asset('/layui/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ URL::asset('/layui/js/xadmin.js') }}"></script>
</head>
<body>
<script id="container" name="content" type="text/plain">
    这里写你的初始化内容
</script>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="username" class="layui-form-label">
                    <span class="x-red">*</span>标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="title" name="title" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
{{--            <div class="layui-form-item">--}}
{{--                <label for="phone" class="layui-form-label">--}}
{{--                    <span class="x-red">*</span>内容--}}
{{--                </label>--}}
{{--                <div>--}}
{{--                    <textarea type="text" id="phone" name="content" style="width: 400px;height: 200px;"></textarea>--}}
{{--                </div>--}}
{{--            </div>--}}
            <script id="editor" type="text/plain" name="content" style="width:1024px;height:500px;"></script>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button type="button" class="layui-btn" id="button" lay-filter="add" lay-submit="">
{{--                <button type="button" class="layui-btn" id="button">--}}
                    增加
                </button>
            </div>
        </form>
    </div>
</div>

{{--<script id="container" name="content" type="text/plain">--}}
{{--    这里写你的初始化内容--}}
{{--</script>--}}
<!-- ueditor-mz 配置文件 -->
<script type="text/javascript" src="{{ URL::asset('/ueditor-mz/utf8-php/ueditor.config.js')}}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ URL::asset('/ueditor-mz/utf8-php/ueditor.all.js')}}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    // var ue = UE.getEditor('ue-container');

</script>

<script src="{{ URL::asset('/root/assets/assets/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('/root/assets/assets/js/amazeui.ie8polyfill.min.js') }}"></script>

<script>

    layui.use(['form', 'layer'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;


            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data);
                    var arr = [];
                    arr.push(UE.getEditor('editor').getPlainTxt());
                    var content =arr.join()
                    var title = $("#title").val();
                    console.log(title)
                    console.log(content)
                    //发异步，把数据提交给php
                    $.post("/create", {title:title , content:content}, function (res) {
                        if (res.status == 0) {
                            layer.alert(res.msg, {
                                    icon: 5
                                },
                                function () {
                                    // 获得frame索引
                                    var index = parent.layer.getFrameIndex(window.name);
                                    //关闭当前frame
                                    parent.layer.close(index);
                                });
                            return false;
                        }
                        layer.alert("新增成功", {
                                icon: 6
                            },
                            function () {
                                // 获得frame索引
                                var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                parent.layer.close(index);
                                parent.document.reload();
                            });
                    });

                    return false;
                });

        });
</script>
<script>
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>

</html>

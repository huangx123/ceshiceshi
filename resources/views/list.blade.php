<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>后台</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="{{ URL::asset('/layui/css/font.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('/layui/css/xadmin.css') }}">
        <script src="{{ URL::asset('/layui/lib/layui/layui.js') }}" charset="utf-8"></script>
        <script type="text/javascript" src="{{ URL::asset('/layui/js/xadmin.js') }}"></script>
    </head>
    <body>

        <div class="x-nav">

          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"href="/logout" title="刷新">
              <div style="margin-top: 6px;">退出</div>
         </a>

        </div>


        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <a class="layui-btn" href="/list">重置</a>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn" onclick="xadmin.open('添加','./add',600,400)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>标题</th>
                                  <th>内容</th>
                                  <th>加入时间</th>
                                  <th>更新时间</th>
{{--                                  <th>状态</th>--}}
                                  <th>操作</th>
                              </thead>
                              <tbody>
                              @foreach($messages as $data)
                                <tr>
                                  <td>{{$data->id}}</td>
                                  <td>{{$data->title}}</td>
                                  <td>{{$data->content}}</td>
                                  <td>{{$data->created_at}}</td>
                                  <td>{{$data->updated_at}}</td>
                                  <td class="td-status">
                                    <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                                  <td class="td-manage">
                                    <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                                      <i class="layui-icon">&#xe601;</i>
                                    </a>
                                    <a title="编辑"  onclick="xadmin.open('编辑','./edit/?id={{$data->id}}')" href="javascript:;">
                                      <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" onclick="member_del(this,'{{$data->id}}')" href="javascript:;">
                                      <i class="layui-icon">&#xe640;</i>
                                    </a>
                                  </td>
                                </tr>
                              @endforeach
                              </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
                                    {!! $messages->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>

      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var form = layui.form;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){


          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });

          $.ajax({
              type: 'post',
              url: '/delete',
              data: {id:id},
              dataType: 'json',
              success: function(data){
                  //验证成功后实现跳转
                  window.location.href = "/list";
              },
              error: function(msg , status){
                  alert(msg.responseJSON.msg);
              }


          })
      }

    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
</html>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>LOG-IN | Amaze UI Examples</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="{{ URL::asset('/root/assets/assets/i/favicon.png') }}">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="{{ URL::asset('/root/assets/assets/i/app-icon72x72@2x.png') }}">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('/root/assets/assets/i/app-icon72x72@2x.png') }}">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="{{ URL::asset('/root/assets/assets/i/app-icon72x72@2x.png') }}">
{{--  <meta name="msapplication-TileImage" content="assets/i/app-icon72x72@2x.png">--}}
  <meta name="msapplication-TileColor" content="#0e90d2">

  <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
  <!--
  <link rel="canonical" href="http://www.example.com/">
  -->
  <link rel="stylesheet" href="{{ URL::asset('/root/assets/assets/css/amazeui.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('/root/assets/assets/css/app.css') }}">
</head>
<body>
<header>
  <div class="log-header">
      <h1><a href="/">Amaze UI</a> </h1>
  </div>

</header>

<div class="log">
  <div class="am-g">
  <div class="am-u-lg-3 am-u-md-6 am-u-sm-8 am-u-sm-centered log-content">
    <h1 class="log-title am-animation-slide-top">AmazeUI</h1>
    <br>
    <form class="am-form" id="login_form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="am-input-group am-radius am-animation-slide-left">
        <input type="email" id="email" class="am-radius" data-validation-message="请输入正确邮箱地址" placeholder="邮箱" required/>
        <span class="am-input-group-label log-icon am-radius"><i class="am-icon-user am-icon-sm am-icon-fw"></i></span>
      </div>
      <br>
      <div class="am-input-group am-animation-slide-left log-animation-delay">
        <input type="text" id="password" class="am-form-field am-radius log-input" placeholder="密码" minlength="5" required>
        <span class="am-input-group-label log-icon am-radius"><i class="am-icon-lock am-icon-sm am-icon-fw"></i></span>
      </div>
      <br>
      <button type="button" class="btn am-btn am-btn-primary am-btn-block am-btn-lg am-radius am-animation-slide-bottom log-animation-delay">登 录</button>

    </form>
  </div>
  </div>
  <footer class="log-footer">
    © 2014 AllMobilize, Inc. Licensed under MIT license.
  </footer>
</div>
<script src="{{ URL::asset('/root/assets/assets/js/jquery.min.js') }}"></script>

<script src="{{ URL::asset('/root/assets/assets/js/amazeui.ie8polyfill.min.js') }}"></script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
 $(function () {

   $(".btn").click(function(){
     // var email = $(this).substring("tr").find(".id").text();
     // $.post("/posts.in_login",$("#login_form").serialize(),function(res){
     //    if(res.status != 1){
     //      console.log(res.msg);
     //    }
     // })
       var email = $("#email").val();
       var password = $("#password").val();
     if (!email) {
       alert('请输入邮箱');
       return;
     }

     $.ajax({
       type: 'POST',
       url: '/in_login',
       data: {email:email , password: password},
       dataType: 'json',
       success: function(data){
         //验证成功后实现跳转
         window.location.href = "/list";
       },
       error: function(msg , status){
         alert(msg.responseJSON.msg);
       }


     })

   });

 })


</script>

</body>
</html>
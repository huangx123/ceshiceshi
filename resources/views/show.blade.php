<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>提交留言-hovertree</title>
    <style>

    </style>
</head>
<body>
<form action="/add" method="post" class="messages">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="messlist">
        <label>标题</label>
        <input type="text" name="title" placeholder="姓名" />
        <div class="title"></div>
    </div>

    <div class="messlist textareas">
        <label>留言内容</label>
        <textarea name="content" placeholder="留言内容"></textarea>
        <div class="content"></div>
    </div>

    <div class="messsub">
        <input type="submit" value="提交" style="background:#00a3eb;color:#fff;" />
        <input type="reset" value="重填" />
    </div>
</form>
</body>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</html>
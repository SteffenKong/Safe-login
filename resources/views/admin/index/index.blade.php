<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>管理员信息</h1>
    <h2>账号:</h2>
    <h2>邮箱:</h2>
    <h2>状态:</h2>
    <h2>注册时间:</h2>
</body>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/cookie/jquery.cookie.js"></script>
</html>
<script type="text/javascript">
    $(function() {
        let token = $.cookie('token');
        $.ajaxSetup({
            headers: { 'token' : $("meta[name='jwt']").attr(token) }
        });
    });
</script>

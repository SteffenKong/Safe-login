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
<a href="javascript:void(0);" style="text-decoration: none;color:black; float: right;" id="logout">退出登录</a>
    <h1>管理员信息</h1>
    <h2>账号:<span></span></h2>
    <h2>邮箱:<span></span></h2>
    <h2>状态:<span></span></h2>
    <h2>注册时间:<span></span></h2>
</body>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/cookie/jquery.cookie.js"></script>
</html>
<script type="text/javascript">
    $(function() {
        let token = $.cookie('token');  //在cookie中获取token
        if(token == '' || token == null) {
            alert('未登录');
            console.log(123);
            window.location.href = '/login';
        }
        $.ajax({
            url:'/admin/getIndexData',
            headers:{
                token:token     //在头部header请求头带上token
            },
            dataType:'Json',
            type:'GET',
            success:(data)=>{
                if(data.code === '000') {
                    let adminData = data.data;
                    console.log(adminData);
                    $('span:eq(0)').text(adminData.admin.account);
                    $('span:eq(1)').text(adminData.admin.email);
                    $('span:eq(2)').text(adminData.admin.status == 1 ? '启用':'禁用');
                    $('span:eq(3)').text(adminData.admin.createdAt);
                }else if(data.code === '001') {
                    console.log('数据获取失败');
                }else {
                    //未登录
                    window.location.href = '/login';
                }
            }
        });

        //退出登录
        $("#logout").click(function() {
            $.ajax({
                url:'/logout',
                headers:{
                    token:token     //在头部header请求头带上token
                },
                dataType:'Json',
                type:'GET',
                success:(data)=>{
                    if(data.code === '000') {
                        //清空cookie
                        $.cookie('token',null,{ expires: -1 });
                       alert('退出成功');
                        window.location.href = '/login';
                    }else {
                        alert(data.message);
                        // console.log(data.message);
                    }
                }
            });
        });
    });
</script>

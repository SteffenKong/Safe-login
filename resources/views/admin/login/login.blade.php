<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="token" content="{!! csrf_token() !!}" />
    <link rel="stylesheet" type="text/css" href="/static/admin/init.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/login.css" />
    <link rel="stylesheet" type="text/css" href="https://www.layuicdn.com/layui-v2.5.4/css/layui.css" />
    <title>管理后台登录</title>
</head>
<body class="layui-bg-black">
   <h1>管理后台系统</h1>
       <div class="login">
           <form class="layui-form">
                <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-block">
                          <input type="text" id="account" name="account"   placeholder="请输入帐号" autocomplete="off" class="layui-input">
                        </div>
                 </div>

                 <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-input-block">
                          <input type="password" id="password" name="password"    placeholder="请输入密码" autocomplete="off" class="layui-input">
                        </div>
                      </div>

                      <div class="layui-form-item">
                            <label class="layui-form-label">验证码</label>
                            <div class="layui-input-block">
                              <input type="text" id="captcha" name="captcha" autocomplete="off" class="layui-input captcha">
                                <img src="{!! captcha_src('flat') !!}" id="captcha_pic" class="captcha_pic" />
                            </div>
                          </div>
               <img src="" />
               <div class="layui-form-item">
                    <div class="layui-input-block">
                            <button  class="layui-btn sign">登录</button>
                            <button  class="layui-btn find">找回密码</button>
                    </div>
                  </div>

           </form>
       </div>
</body>
</html>
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
<script type="text/javascript" src="/static/admin/jsencrypt/bin/jsencrypt.min.js"></script>
<script type="text/javascript" src="/static/admin/login.js"></script>

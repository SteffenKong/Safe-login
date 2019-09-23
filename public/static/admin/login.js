//设置阻止表单提交
$("form").submit(function() {
    return false;
});


//登录动作
$(".sign").click(function() {
    let account = $("#account").val();
    let password = $("#password").val();
    let captcha = $("#captcha").val();

    let flag = true;

    if(account === '') {
        layer.msg('请填写用户名',{icon:2});
        flag = false;
    }

    if(password === '') {
        layer.msg('请填写密码',{icon:2});
        flag = false;
    }

    if(captcha === '') {
        layer.msg('请填写验证码',{icon:2});
        flag = false;
    }

    if(flag === false) {
        return false;
    }

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : $("meta[name='token']").attr('content') }
    });

    //请求后台获取公钥进行加密
    var publicKey = '';
    $.ajax({
        url:'getPublicKey',
        dataType:'json',
        type:'GET',
        data:null,
        success:function(data) {
            if(data.code === '000') {
                publicKey = data.data.publicKey;
                //在这里对密码进行加密
                var enPass = encryptPass(password,publicKey);
                $("#password").val(enPass);
                $.ajax({
                    url:'/sign',
                    dataType:'Json',
                    type:'POST',
                    data:{account:account,password:enPass,captcha:captcha},
                    success:function(data) {
                        if(data.code === '000') {
                            layer.msg('登陆成功',{icon:1});
                            $.cookie('token',data.data.token);
                            setInterval(function() {
                                window.location.href = '/admin/index';
                            },1000);
                        }else if(data.code === '001') {
                            layer.msg(data.message,{icon:2});
                            refreshCaptcha($("#captcha_pic"));
                            $("#password").val(''); //清空密码
                        }else {
                            let errors = data.errors;
                            $.each(errors,function(k,v) {
                                layer.msg(v[0],{icon:2});
                                $("#password").val(''); //清空密码
                                $("#captcha").val('');  //清空验证码
                            });
                            refreshCaptcha($("#captcha_pic"));
                        }
                    }
                });
            }
        }
    });


});

//点击刷新验证码
$("#captcha_pic").click(function() {
    refreshCaptcha($(this));
});


//刷新获取验证码
function refreshCaptcha(obj) {
    let oldAddr = $(obj).attr('src');
    let newAddr = oldAddr+'/#/'+Math.random();
    $(obj).attr('src',newAddr);
}

//对密码进行公钥加密
function encryptPass(password,publicKey) {
    let encrypt = new JSEncrypt();
    encrypt.setPublicKey(publicKey);
    var enPass = encrypt.encrypt(password);
    return enPass
}

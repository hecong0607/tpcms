<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>CMS</title>
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge"/>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="robots" content="noindex,nofollow">
    <link href="__PUBLIC__/admin/css/adminLogin.css" rel="stylesheet"/>
    <style>
        #login_btn_wraper {
            text-align: center;
        }

        #login_btn_wraper .tips_success {
            color: #fff;
        }

        #login_btn_wraper .tips_error {
            color: #DFC05D;
        }

        #login_btn_wraper button:focus {
            outline: none;
        }
    </style>
    <script>
        if (window.parent !== window.self) {
            document.write = '';
            window.parent.location.href = window.self.location.href;
            setTimeout(function () {
                document.body.innerHTML = '';
            }, 0);
        }
    </script>
    <script type="text/javascript">
        //全局变量
        var GV = {
            DIMAUB: "__ROOT__",
            JS_ROOT: "__PUBLIC__/admin/js/",
            TOKEN: ""
        };
    </script>
    <script src="__PUBLIC__/admin/js/jquery.js"></script>
    <script src="__PUBLIC__/admin/js/wind.js"></script>
</head>
<body>
<div class="wrap">
    <h1><a href="">CMS</a></h1>

    <form method="post" name="login" action="{:U('Public/doLogin')}" autoComplete="off"
          class="form-horizontal js-ajax-form">
        <div class="login">
            <ul>
                <li>
                    <input class="input" id="js-admin-name" required name="username" type="text" placeholder="用户名"
                           title="用户名" value=""/>
                </li>
                <li>
                    <input class="input" id="admin_pwd" type="password" required name="password" placeholder="密码"
                           title="密码"/>
                </li>

                <li class="verifycode-wrapper">
                    <?php $src = U('Admin/Public/verify');?>
                    <img style="cursor:pointer" class="verify_img" src="<?=$src;?>"
                         onClick="this.src='<?=$src;?>'+'?'+Math.random();" title="看不清楚?点击刷新验证码?">
                </li>
                <li>
                    <input class="input" type="text" required name="verify" placeholder="验证码"/>
                </li>
            </ul>
            <div id="login_btn_wraper">
                <button type="submit" name="submit" class="btn js-ajax-submit" data-loadingmsg="登录">登录</button>
            </div>
        </div>
    </form>
</div>
<script src="__PUBLIC__/admin/js/common.js"></script>
</body>
</html>

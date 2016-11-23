<div class="modal fade" id="login-modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    用户登陆
                </h4>
            </div>
            <div class="modal-body clearfix">
                <form id="login-form" class="form-horizontal" method="post" role="form">
                    <input type='hidden' name='csrfmiddlewaretoken' value='1wmdmFVrEsVmuNyiwCSmhtzvvUgKlgF4'/>

                    <div class="form-group">
                        <label for="login-username" class="col-sm-2 control-label">用户名</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="login-username"
                                   placeholder="请输入用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login-password" class="col-sm-2 control-label">密码</label>

                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="login-password"
                                   placeholder="请输入密码">
                        </div>
                    </div>
                    <button id="login-button" type="submit" class="btn btn-primary">
                        登陆
                    </button>
                    <div id="forgetpassword"><a href="/forgetpassword/">忘记密码?&nbsp&nbsp</a></div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal -->
</div>
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    用户注册
                </h4>
            </div>
            <div class="modal-body clearfix">
                <form id="register-form" class="form-horizontal" method="post" role="form">
                    <input type='hidden' name='csrfmiddlewaretoken' value='1wmdmFVrEsVmuNyiwCSmhtzvvUgKlgF4'/>

                    <div class="form-group">
                        <label for="register-username" class="col-sm-2 control-label">用户名</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="register-username"
                                   placeholder="请输入用户名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register-email" class="col-sm-2 control-label">email</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="register-email"
                                   placeholder="请输入email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register-password-1" class="col-sm-2 control-label">密码</label>

                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="register-password-1"
                                   placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register-password-2" class="col-sm-2 control-label">确认密码</label>

                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="register-password-2"
                                   placeholder="请再次输入密码">
                        </div>
                    </div>

                    <button id="register-button" type="submit" class="btn btn-primary pull-right">
                        注册
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript">
    $('#login-form').submit(function () {
        $.ajax({
            type: "POST",
            url: "/usercontrol/login",
            data: {"username": $("#login-username").val(), "password": $("#login-password").val()},
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
            },
            success: function (data, textStatus) {
                var errors = data["errors"];
                if (errors.length == 0) {
                    location.reload();
                }
                else {
                    //alert(errors);
                    var html = "<div class=\"alert alert-danger\">"
                    for (var key in errors) {
                        html += errors[key] + "<br/>";
                    }
                    html += "</div>";
                    $("#login-modal .modal-header").after(html);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
        return false;
    });

    $("#login-button").click(function () {
        $("#login-modal .alert").remove();
    });
    $('#register-form').submit(function () {
        $.ajax({
            type: "POST",
            url: "/usercontrol/register",
            data: {
                "username": $("#register-username").val(), "email": $("#register-email").val(),
                "password1": $("#register-password-1").val(), "password2": $("#register-password-2").val(),
            },
            dataType: 'json',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
            },
            success: function (data, textStatus) {
                var errors = data["errors"];
                if (errors.length == 0) {
                    location.reload();
                }
                else {
                    //alert(errors);
                    var html = "<div class=\"alert alert-danger\">"
                    for (var key in errors) {
                        html += errors[key] + "<br/>";
                    }
                    html += "</div>";
                    $("#register-modal .modal-header").after(html);
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
        return false;
    });
    $("#register-button").click(function () {
        $("#register-modal .alert").remove();
    });
    $("#logout").click(function () {
        $.ajax({
            type: "POST",
            url: "/usercontrol/logout",
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
            },
            success: function (data, textStatus) {
                location.replace("/");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
        return false;
    });
</script>
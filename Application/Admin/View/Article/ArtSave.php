<link rel="stylesheet" type="text/css" href="__PUBLIC__/Editor/dist/css/wangEditor.min.css">

<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="javascript:void(0);">文章列表</a></li>
        <li class="active"><a href="javascript:void(0);">文章添加</a></li>
    </ul>
    <form action="{:U('AdminPage/add_post')}" method="post" class="form-horizontal js-ajax-forms" enctype="multipart/form-data">
        <input type="hidden" name="post[post_type]" value="2">
        <div class="row-fluid">
            <div class="span9">
                <table class="table table-bordered">
                    <tr>
                        <th width="80">标题</th>
                        <td>
                            <input type="text" style="width: 400px;" name="post[post_title]" id="title" value="" placeholder="请输入标题"/>
                            <span class="form-required">*</span>
                        </td>
                    </tr>
                    <tr>
                        <th>标签</th>
                        <td><input type="text" name="post[post_keywords]" id="keywords" value="" style="width: 280px" placeholder="请输入标签"> 多标签之间用“，”隔开</td>
                    </tr>
                    <tr>
                        <th>摘要</th>
                        <td><textarea name="post[post_excerpt]" id="description" style='width: 98%; height: 50px;'></textarea></td>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <td>
                            <textarea id="div1" style="width: 100%;height: 500px;">
                                <p>请输入内容...</p>
                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="span3">
                <table class="table table-bordered">
                    <tr>
                        <th>缩略图</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="smeta[thumb]" id="thumb" value="">
                                <a href="javascript:void(0);" onclick="$('#file').click();">
                                    <img src="__PUBLIC__/admin/assets/images/default-thumbnail.png" id="thumb_preview" width="135" style="cursor: hand"/>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>发布时间</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="post[post_modified]" value="{:date('Y-m-d H:i:s',time())}" class="js-datetime"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary js-ajax-submit" type="submit">保存</button>
            <a class="btn" href="{:U('AdminPage/index')}">返回</a>
        </div>
    </form>
    <form id="image" style="display: none;">
        <input type="file" id="file" name="face" onchange="doUpload();">
    </form>
</div>

<!--<script type="text/javascript" src="__PUBLIC__/Editor/js/lib/jquery-1.10.2.min.js"></script>-->
<script type="text/javascript" src="__PUBLIC__/Editor/dist/js/wangEditor.min.js"></script>
<script type="text/javascript">
    $(function () {
        var editor = new wangEditor('div1');
        // 普通的自定义菜单
        editor.config.menus = [
            'source',
            '|',
            'bold',
            'underline',
            'italic',
            'strikethrough',
            'eraser',
            'forecolor',
            'bgcolor',
            '|',
            'quote',
            'fontfamily',
            'fontsize',
            'head',
            'unorderlist',
            'orderlist',
            'alignleft',
            'aligncenter',
            'alignright',
            '|',
            'link',
            'unlink',
            'table',
            'emotion',
            '|',
            'img',
            'video',
            'location',
            'insertcode',
            '|',
            'undo',
            'redo',
            'fullscreen'
        ];
        editor.create();
    });
</script>
<!---->
<!--<script type="text/javascript">-->
<!--    //编辑器路径定义-->
<!--    var editorURL = GV.DIMAUB;-->
<!--</script>-->
<!---->
<!--<script type="text/javascript" src="__PUBLIC__/admin/js/ueditor/ueditor.config.js"></script>-->
<!--<script type="text/javascript" src="__PUBLIC__/admin/js/ueditor/ueditor.all.min.js"></script>-->
<script type="text/javascript">
    $(function() {
        $(".js-ajax-close-btn").on('click', function(e) {
            e.preventDefault();
            Wind.use("artDialog", function() {
                art.dialog({
                    id : "question",
                    icon : "question",
                    fixed : true,
                    lock : true,
                    background : "#CCCCCC",
                    opacity : 0,
                    content : "您确定需要关闭当前页面嘛？",
                    ok : function() {
                        setCookie("refersh_time", 1);
                        window.close();
                        return true;
                    }
                });
            });
        });
        /////---------------------
        Wind.use('validate','ajaxForm','artDialog',function() {
            //编辑器
            editorcontent = new baidu.editor.ui.Editor();
            editorcontent.render('content');
            try {
                editorcontent.sync();
            } catch (err) {}
            //增加编辑器验证规则
            jQuery.validator.addMethod('editorcontent',function() {
                try {
                    editorcontent.sync();
                } catch (err) {}
                return editorcontent.hasContents();
            });

            var form = $('form.js-ajax-forms');
            //ie处理placeholder提交问题
            if ($.browser.msie) {
                form.find('[placeholder]').each(function() {
                    var input = $(this);
                    if (input.val() == input
                            .attr('placeholder')) {
                        input.val('');
                    }
                });
            }
            //表单验证开始
            form.validate({
                //是否在获取焦点时验证
                onfocusout : false,
                //是否在敲击键盘时验证
                onkeyup : false,
                //当鼠标掉级时验证
                onclick : false,
                //验证错误
                showErrors : function(errorMap,errorArr) {
                    //errorMap {'name':'错误信息'}
                    //errorArr [{'message':'错误信息',element:({})}]
                    try {
                        $(errorArr[0].element).focus();
                        art.dialog({
                            id : 'error',
                            icon : 'error',
                            lock : true,
                            fixed : true,
                            background : "#CCCCCC",
                            opacity : 0,
                            content : errorArr[0].message,
                            cancelVal : '确定',
                            cancel : function() {
                                $(errorArr[0].element).focus();
                            }
                        });
                    } catch (err) {}
                },
                //验证规则
                rules : {
                    'post[post_title]' : {required : 1},
                    'post[post_content]' : {editorcontent : true}
                },
                //验证未通过提示消息
                messages : {
                    'post[post_title]' : {required : '请输入标题'},
                    'post[post_content]' : {editorcontent : '内容不能为空'}
                },
                //给未通过验证的元素加效果,闪烁等
                highlight : false,
                //是否在获取焦点时验证
                onfocusout : false,
                //验证通过，提交表单
                submitHandler : function(forms) {
                    $(forms).ajaxSubmit({
                        url : form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
                        dataType : 'json',
                        beforeSubmit : function(arr,$form,options) {

                        },
                        success : function(data,statusText,xhr,$form) {
                            if (data.status) {
                                setCookie("refersh_time",1);
                                //添加成功
                                Wind.use("artDialog",function() {
                                    art.dialog({
                                        id : "succeed",
                                        icon : "succeed",
                                        fixed : true,
                                        lock : true,
                                        background : "#CCCCCC",
                                        opacity : 0,
                                        content : data.info,
                                        button : [
                                            {
                                                name : '继续添加？',
                                                callback : function() {
                                                    reloadPage(window);
                                                    return true;
                                                },
                                                focus : true
                                            },
                                            {
                                                name : '返回列表',
                                                callback : function() {
                                                    location.href = "{:U('AdminPage/index')}";
                                                    return true;
                                                }
                                            }
                                        ]
                                    });
                                });
                            } else {
                                alert(data.info);
                            }
                        }
                    });
                }
            });
        });
    });

    function doUpload() {
        var formData = new FormData($( "#image" )[0]);
        $.ajax({
            url: "{:U('Admin/Article/FaceUpload')}" ,
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
                console.log(returndata);
                $('#thumb_preview').attr('src','http://avatar.csdn.net/B/7/8/1_weizengxun.jpg');
            },
            error: function (returndata) {
                console.log(returndata);
            }
        });
    }
</script>

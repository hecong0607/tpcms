<!-- 文章列表 与 侧边的东西 -->
<div id="vmaig-content" class="col-md-8 col-lg-9">
    <div id="tool" class="well clearfix">
        <div class="tags">
            <div class="tag-list" style="float:left">
                <label class="active">
                    全部
                    <input type="radio" name="category" value="all" style="display:none">
                </label>

                <label>
                    linux
                    <input type="radio" name="category" value="linux" style="display:none">
                </label>
            </div>
        </div>
    </div>
    <div class="well">
        <div class="sort">
            <label>
                <input type="radio" name="sort" value="time" checked="checked"> 按时间排序
            </label>
            <label>
                <input type="radio" name="sort" value="recommend"> 按热度排序
            </label>
            <label>
                <input type="radio" name="sort" value="comment"> 按评论排序
            </label>
        </div>
        <div id="all-post-list">


            <div class="all-post clearfix underline">
                <div class="post-title clearfix">
                    <a href="/category/linux/">
                        <div class="pre-cat">
                            <div class="pre-catinner btn">
                                linux
                            </div>
                            <div class="pre-catarrow">
                            </div>
                        </div>
                    </a>

                    <h1><a href="/article/linux_program_study_note_18.html">linux 环境编程学习笔记 第25天
                            信号量(进程同步)</a></h1>

                    <div class="post-tags" style="float:right">

                        <a href="/tag/linux/">
                            <span class="label label-vmaig-1 btn">linux</span>
                        </a>

                        <a href="/tag/C/">
                            <span class="label label-vmaig-2 btn">C</span>
                        </a>

                    </div>
                </div>
                <div class="post-content ">
                    <div class="row">
                        <div class="col-sm-4">
                            <figure class="thumbnail">
                                <a href="/article/linux_program_study_note_18.html">
                                    <img src="images/linux-article.jpg" height="400" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="col-sm-8">
                            <p>

                            <p>一、信号量(进程同步) 模型 (1)创建或者得到信号量 semget int semget(key_t key, int nsems,
                                //信号量数组的个数 int semflg); ////信号量的创建标记 创建：IPC_CREAT IPC_EXCL(防止重复创建)，打开：就是0
                                (2)初始化信号量中指定下标的值 semctl int semctl(int semid, int semnu


                                ...

                            </p>
                        </div>
                    </div>
                </div>
                <div class="post-info">
                    <span>
                        <span class="glyphicon glyphicon-calendar"></span>
                        2015-05-07
                    </span>
                    <span>
                        <span class="glyphicon glyphicon-comment"></span>
                        0
                    </span>
                    <span>
                        <span class="glyphicon glyphicon-eye-open"></span>
                        1450
                    </span>
                </div>
            </div>
        </div>
        <div id="loading" style="height:100px;line-height:100px;text-align:center;display:none;">
            <img src="images/loading.gif" alt="">
        </div>
    </div>
    <button id="all-post-more" type="button" class="btn btn-vmaig" value="all" style="width:100%">
        加载更多
        <span class="glyphicon glyphicon-menu-down"></span>
    </button>
</div>
<script language="javascript" type="text/javascript">
    var start = 0;
    var end = parseInt(8);
    $("input[name='category']").click(function () {
        start = 0;
        end = parseInt(8);
        $("input[name='category']").parent().removeClass("active");
        $("#all-post-more")[0].style.display = "none";
        $("#loading")[0].style.display = "block";
        $("#all-post-list").empty();
        $(this).parent().addClass("active");
        $("#all-post-more").val($(this).val());
        $.ajax({
            type: "POST",
            url: "/all/",
            data: {
                "val": $(this).attr("value"),
                "sort": $("input[name='sort']:checked").val(),
                "start": start,
                "end": end
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
            },
            success: function (data, textStatus) {
                $("#loading")[0].style.display = "none";
                $('#all-post-list').append(data["html"]);
                if (data["isend"]) {
                    $("#all-post-more")[0].style.display = "none";
                } else {
                    $("#all-post-more")[0].style.display = "block";
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
    });
    $("input[name='sort']").click(function () {
        start = 0;
        end = parseInt(8);
        $("#all-post-more")[0].style.display = "none";
        $("#loading")[0].style.display = "block";
        $("#all-post-list").empty();
        $.ajax({
            type: "POST",
            url: "/all/",
            data: {
                "val": $("label.active input").val(),
                "sort": $("input[name='sort']:checked").val(),
                "start": start,
                "end": end
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
            },
            success: function (data, textStatus) {
                $("#loading")[0].style.display = "none";
                $('#all-post-list').append(data["html"]);
                if (data["isend"]) {
                    $("#all-post-more")[0].style.display = "none";
                } else {
                    $("#all-post-more")[0].style.display = "block";
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
    });
    
    $("#all-post-more").click(function () {
        start = end;
        end += 5;
        $("#loading")[0].style.display = "block";
        $.ajax({
            type: "POST",
            url: "/all/",
            data: {
                "val": $(this).attr("value"),
                "sort": $("input[name='sort']:checked").val(),
                "start": start,
                "end": end
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
            },
            success: function (data, textStatus) {
                $("#loading")[0].style.display = "none";
                $("#all-post-more")[0].style.display = "none";
                $('#all-post-list').append(data["html"]);
                if (data["isend"]) {
                    $("#all-post-more")[0].style.display = "none";
                } else {
                    $("#all-post-more")[0].style.display = "block";
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
    });
</script>

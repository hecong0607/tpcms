<!-- 文章列表 与 侧边的东西 -->
<div id="vmaig-content" class="col-md-8 col-lg-9">
    <div id="article-page" class="well">
        <ol class="breadcrumb">
            <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="/category/linux/">linux</a></li>
            <li class="hidden-xs"><a><span class="glyphicon glyphicon-calendar"></span> 2015-05-07</a></li>
            <li><a>
                    <span class="glyphicon glyphicon-eye-open"></span>
                    1440
                </a></li>
            <li class="pull-right"><a>
                    <span class="glyphicon glyphicon-user"></span> billvsme
                </a></li>
        </ol>
        <div id="article">
            <div class="article-title">
                <h1>linux 环境编程学习笔记 第一天 linux 内存管理 </h1>
            </div>
            <div class="article-tags">

                <a href="/tag/linux/">
                    <span class="label label-vmaig-1 btn">linux</span>
                </a>

                <a href="/tag/C/">
                    <span class="label label-vmaig-2 btn">C</span>
                </a>

            </div>
            <hr/>
            <div class="article-content">

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <h1><strong><span style="font-size: 24px; color: #ff0000;">linux 环境编程</span></strong></h1>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <h2><span style="color: #ff0000;"><span style="font-size: 24px;">一、linux 内存管理</span><span
                            style="font-size: 18px;">&nbsp;</span></span></h2>

                <h3><strong><span style="font-size: 24px;">1. &nbsp; 变量空间</span></strong></h3>

                <p><span style="font-size: 18px;">linux 每运行一个程序都会在/proc内生成一个跟自己pid一样的文件夹，你面放着程序有关的信息</span></p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p><span style="font-size: 18px;">ldd ./1<br/> </span></p>

                <p><span style="font-size: 18px;">可以看到</span></p>

                <p><span style="font-size: 14px;">linux-vdso.so.1 (0x00007fff47eac000)<br/> libc.so.6 =&gt; /lib64/libc.so.6 (0x00007f37c4414000)<br/> /lib64/ld-linux-x86-64.so.2 (0x00007f37c47bc000)</span>
                </p>

                <p><span style="font-size: 14px;"><span style="font-size: 14px;">/lib64/ld-linux-x86-64.so.2是一个可执行文件 用来生成 /proc/${pid}内的文件</span><br/> </span>
                </p>

                <p><span style="font-size: 14px;"><span style="font-size: 14px;"><br/> </span></span></p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p>&nbsp;</p>

<pre class="brush:cpp;"><span style="font-size: 14px;">#include&lt;stdio.h&gt;

#include&lt;unistd.h&gt;

#include&lt;malloc.h&gt;

int a1;

static int a2=2;

const int a3=2;

int add(int a,int b)

{

    return a+b;

}

int main()

{



    int b1;

    static int b2=2;

    const int b3=2;

    int *p1;

    int *p2 = (int *)malloc(4);

    printf("a1 %p\n",&amp;a1);

    printf("a2 %p\n",&amp;a2);

    printf("a3 %p\n",&amp;a3);

    printf("b1 %p\n",&amp;b1);

    printf("b2 %p\n",&amp;b2);

    printf("b3 %p\n",&amp;b3);

    printf("p1 %p\n",p1);

    printf("p2 %p\n",p2);

    printf("main %p\n",main);

    printf("f %p\n",add);

    printf("%d\n",getpid());

    while(1);

    return 0;

}</span>

</pre>

                <p><br/> <span style="font-size: 18px;">结果</span></p>

                <p>&nbsp;</p>

                <p><span
                        style="font-size: 14px;">a1 0x601060<br/> a2 0x601048<br/> a3 0x400828<br/> b1 0x7fffaa41f41c<br/> b2 0x60104c<br/> b3 0x7fffaa41f418<br/> p1 0x7fffaa41f510<br/> p2 0xddd010<br/> main 0x4005e8<br/> f 0x4005d4<br/> 18155</span>
                </p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p><span style="font-size: 18px;">cat /proc/18155/map 结果</span></p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p><span style="font-size: 14px;">00400000-00401000 r-xp 00000000 08:13 1845721 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/codes/gj/1<br/> 00600000-00601000 r--p 00000000 08:13 1845721 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/codes/gj/1<br/> 00601000-00602000 rw-p 00001000 08:13 1845721 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/codes/gj/1<br/> 00ddd000-00dfe000 rw-p 00000000 00:00 0 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[heap]<br/> 7f7916efa000-7f7917099000 r-xp 00000000 08:13 2883641 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/libc-2.15.so<br/> 7f7917099000-7f7917298000 ---p 0019f000 08:13 2883641 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/libc-2.15.so<br/> 7f7917298000-7f791729c000 r--p 0019e000 08:13 2883641 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/libc-2.15.so<br/> 7f791729c000-7f791729e000 rw-p 001a2000 08:13 2883641 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/libc-2.15.so<br/> 7f791729e000-7f79172a2000 rw-p 00000000 00:00 0&nbsp;<br/> 7f79172a2000-7f79172c3000 r-xp 00000000 08:13 2883719 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/ld-2.15.so<br/> 7f7917490000-7f7917493000 rw-p 00000000 00:00 0&nbsp;<br/> 7f79174c1000-7f79174c3000 rw-p 00000000 00:00 0&nbsp;<br/> 7f79174c3000-7f79174c4000 r--p 00021000 08:13 2883719 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/ld-2.15.so<br/> 7f79174c4000-7f79174c5000 rw-p 00022000 08:13 2883719 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;/lib64/ld-2.15.so<br/> 7f79174c5000-7f79174c6000 rw-p 00000000 00:00 0&nbsp;<br/> 7fffaa400000-7fffaa421000 rw-p 00000000 00:00 0 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[stack]<br/> 7fffaa444000-7fffaa445000 r-xp 00000000 00:00 0 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[vdso]<br/> ffffffffff600000-ffffffffff601000 r-xp 00000000 00:00 0 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[vsyscall]</span>
                </p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p><span style="font-size: 18px;">可以知道 &nbsp;全局的 普通变量、静态变量放在 全局栈中，全局 const变量 放在 代码区 。</span></p>

                <p><span style="font-size: 18px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 局部普通变量 和const变量都放在局部栈中，static变量放在&nbsp;<span
                            style="font-size: 18px;">全局栈中。malloc申请的空间放在 堆中。</span></span></p>

                <p><span style="font-size: 18px;"><span style="font-size: 18px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; main函数 和 自己写的函数 都是放在 代码区的。</span></span>
                </p>

                <p><span style="font-size: 18px;"><span style="font-size: 18px;"><br/> </span></span></p>

                <h3><span style="font-size: 24px;">2.malloc 申请的内存</span></h3>

                <p>&nbsp;</p>

<pre class="brush:cpp;"><span style="font-size: 14px;">#include&lt;stdio.h&gt;

#include&lt;unistd.h&gt;

#include &lt;malloc.h&gt;



int main(int argc, const char *argv[])

{

    int a1 = 10;

    int a2 = 10;

    int a3 = 10;



    int *p1 = (int*)malloc(4);

    int *p2 = (int*)malloc(4);

    int *p3 = (int*)malloc(4);



    printf("a1 %p\n",&amp;a1);

    printf("a2 %p\n",&amp;a2);

    printf("a3 %p\n",&amp;a3);



    printf("p1 %p\n",p1);

    printf("p2 %p\n",p2);

    printf("p3 %p\n",p3);





    printf("%d\n",getpid());

    while(1);

    return 0;

}





结果：

a1 0x7fff4445f7a4

a2 0x7fff4445f7a0

a3 0x7fff4445f79c

p1 0x1dcb010

p2 0x1dcb030

p3 0x1dcb050

18323</span></pre>

                <p>&nbsp;</p>

                <p>&nbsp;</p>

                <p><span
                        style="font-size: 18px;">可以知道：<br/> 1. 普通变量是在栈中的，它的地址是 越早分配的地址越大，malloc 创建的内存是在堆中的地址是按顺序分配下来的<br/> 2. malloc申请的变量不是申请4个字节就只占用4个直接，具体见后面。</span>
                </p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <h3><span style="font-size: 24px;"><strong>3.malloc申请的内存结构</strong></span></h3>

                <p>&nbsp;</p>

<pre class="brush:cpp;" style="font-weight: bold;"><span style="font-size: 14px;">#include&lt;stdio.h&gt;

#include&lt;malloc.h&gt;



int main(int argc, const char *argv[])

{

    int *p1 = malloc(4);

    int *p2 = malloc(4);

    int *p3 = malloc(4);

    *p1 = 1;

    *(p1+1) = 2;

    *(p1+2) = 3;

    *(p1+3) = 4;

    *(p1+4) = 5;

    *(p1+5) = 6;

    *(p1+6) = 7;

    *(p1+7) = 8;

    *(p1+8) = 10;

    *(p1+9) = 11;



    //free(p1);

    printf("%d\n",*p2);

    return 0;

}

结果：

10</span></pre>

                <p>&nbsp;</p>

                <p style="font-weight: bold;"><strong><br/> </strong></p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p><span style="font-size: 18px;">虽然看起来没有什么错，但如果 free(p1)就会出现严重的错误。<br/> 原因 &nbsp; 堆是由链表管理的，<span
                            style="color: #ff0000;">malloc 生成的空间 &nbsp;先本身的数据，再是前一个元素的地址，再是后一个元素的地址，再后一个是本身数据的长度</span>。所以改变 p1+2 p1+3 的值会使 free 出错。</span>
                </p>

                <p><span style="font-size: 18px;"><br/> </span></p>

                <p>&nbsp;</p>

                <h3><span style="font-size: 24px;">4.</span><span
                        style="font-size: 18px;">new delete跟 malloc free有什么区别</span></h3>

                <p><span style="font-size: 18px;">new就是靠malloc的 delete 就是靠free的，</span><br/> <span
                        style="font-size: 18px;">只是new 在生成是会初始化，delete在删除是会先清0。</span><br/> <br/> <span
                        style="font-size: 24px;"><br/> <strong>其他知识点：</strong></span><br/> <span
                        style="font-size: 18px;">c语言是弱类型语言，c++是强类型语言</span><br/> <span style="font-size: 18px;">int *p = malloc(4);</span><br/>
                    <span style="font-size: 18px;">在c是对的，在c++是错的，c++一定要(int*)malloc(4);</span><br/> <span
                        style="font-size: 18px;">gcc xxx.cpp 是按照c++ 编译的</span><br/> <span style="font-size: 18px;">gcc xxx.c &nbsp; &nbsp; 才会按照c编译</span>
                </p>

                <p>&nbsp;</p>

            </div>
        </div>
    </div>
    <!--评论框 -->
    <div id="anchor-quote"></div>
    <div class="well">
        <div class="vmaig-comment">
            <div class="vmaig-comment-tx">

                <img src="images/tx-default.jpg" width="40"></img>

            </div>
            <div class="vmaig-comment-edit clearfix">
                <form id="vmaig-comment-form" method="post" role="form">
                    <input type='hidden' name='csrfmiddlewaretoken' value='1wmdmFVrEsVmuNyiwCSmhtzvvUgKlgF4'/>
                    <textarea id="comment" name="comment" class="form-control" rows="4"
                              placeholder="请输入评论 限200字!"></textarea>
                    <button type="submit" class="btn btn-vmaig-comments pull-right">提交</button>
                </form>
            </div>
            <ul>

                <li>
                    <div class="vmaig-comment-tx">

                        <img src=images/default.jpg width="40"></img>

                    </div>
                    <div class="vmaig-comment-content">
                        <a><h1>ganxie_blog</h1></a>

                        <p></p>

                        <p>
                            评论：

                            测试，感谢开源

                        </p>

                        <p>2015-12-24 23:15:04 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class='quote'
                                                                                           href="#anchor-quote"
                                                                                           onclick="return CommentQuote('ganxie_blog',75);">回复</a>
                        </p>
                    </div>
                </li>

                <li>
                    <div class="vmaig-comment-tx">

                        <img src=images/tx_100x100_78.jpg width="40"></img>

                    </div>
                    <div class="vmaig-comment-content">
                        <a><h1>zhangqin</h1></a>

                        <p></p>

                        <p>
                            评论：

                            test again

                        </p>

                        <p>2015-07-06 15:57:02 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class='quote'
                                                                                           href="#anchor-quote"
                                                                                           onclick="return CommentQuote('zhangqin',41);">回复</a>
                        </p>
                    </div>
                </li>

                <li>
                    <div class="vmaig-comment-tx">

                        <img src=images/tx_100x100_78.jpg width="40"></img>

                    </div>
                    <div class="vmaig-comment-content">
                        <a><h1>zhangqin</h1></a>

                        <p></p>

                        <p>
                            评论：

                            test

                        </p>

                        <p>2015-07-06 15:56:55 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class='quote'
                                                                                           href="#anchor-quote"
                                                                                           onclick="return CommentQuote('zhangqin',40);">回复</a>
                        </p>
                    </div>
                </li>

                <li>
                    <div class="vmaig-comment-tx">

                        <img src=images/tx_100x100_1.jpg width="40"></img>

                    </div>
                    <div class="vmaig-comment-content">
                        <a><h1>billvsme</h1></a>

                        <p></p>

                        <p>
                            评论：

                            加我 qq 994171686

                        </p>

                        <p>2015-05-15 00:16:29 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class='quote'
                                                                                           href="#anchor-quote"
                                                                                           onclick="return CommentQuote('billvsme',12);">回复</a>
                        </p>
                    </div>
                </li>

                <li>
                    <div class="vmaig-comment-tx">

                        <img src=images/default.jpg width="40"></img>

                    </div>
                    <div class="vmaig-comment-content">
                        <a><h1>shadow</h1></a>

                        <p></p>

                        <p>
                            评论：

                            楼主，我用你开源的代码部署后，怎么什么都不能干。。。比如添加文章什么的

                        </p>

                        <p>2015-05-14 20:55:06 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class='quote'
                                                                                           href="#anchor-quote"
                                                                                           onclick="return CommentQuote('shadow',11);">回复</a>
                        </p>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <script language="javascript" type="text/javascript">
        function CommentQuote(user_name, commend_id) {
            comment = document.getElementById('comment');
            comment.value = "@['" + user_name + "', " + commend_id + "]: ";
            comment.focus();
            ;
            comment.setSelectionRange(comment.value.length, comment.value.length);
        }
        ;
        $('#vmaig-comment-form').submit(function () {
            $.ajax({
                type: "POST",
                url: "/comment/linux_program_study_note_01",
                data: {"comment": $("#comment").val()},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("X-CSRFToken", $.cookie('csrftoken'));
                },
                success: function (data, textStatus) {
                    $("#comment").val("");
                    $(".vmaig-comment ul").prepend(data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.responseText);
                }
            });
            return false;
        });
    </script>
</div>
<script type="text/javascript" src="__PUBLIC__/Home/js/vmaig.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shCore.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushCpp.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushJava.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushPython.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushXml.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushPowerShell.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushJScript.js"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>

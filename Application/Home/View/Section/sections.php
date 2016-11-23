<!-- 文章列表 与 侧边的东西 -->
<div id="vmaig-content" class="col-md-8 col-lg-9">
    <div class="well">

        <p>注意：这里讲的是linux环境编程，而非linux的使用</p>

        <h2><span style="color: #ff0000;">应该如何去学习？</span></h2>

        <h3><span style="color: #000000;"><strong>推荐书跟视频：</strong></span></h3>

        <ol>

            <li><span style="color: #000000;"><strong>《unix环境高级编程》</strong></span></li>

            <li><span style="color: #000000;"><strong>视频： &nbsp;<a style="color: #000000;"
                                                                   href="http://pan.baidu.com/s/1qW55gK0">http://pan.baidu.com/s/1qW55gK0</a>&nbsp;
                        &nbsp; （这个视频讲的真的非常不错，<span
                            style="color: #ff0000;">强烈推荐</span>，他大体上是按《unix环境高级编程》来讲的）</strong></span></li>

        </ol>

        <p><span style="color: #000000;">&nbsp;</span></p>

        <h3><span style="color: #000000;"><strong>推荐学习步骤</strong></span></h3>

        <ol>

            <li><span style="color: #000000;"><strong>首先要熟悉linux环境操作，熟悉命令行操作。</strong></span></li>

            <li><span style="color: #000000;"><strong>然后要学会使用vim或者emacs。</strong></span></li>

            <li><strong><span style="color: #000000;">看前面推荐视频，一定要仔细的看不要跳过，可以结合《unix环境高级编程》跟下面的文章</span>一起学习。</strong>
            </li>

        </ol>

    </div>
    <div class="well">


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

                <h1><a href="/article/linux_program_study_note_01.html">linux 环境编程学习笔记 第一天 linux 内存管理 </a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_01.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>linux 环境编程 一、linux 内存管理 1. 变量空间 linux 每运行一个程序都会在/proc内生成一个跟自己pid一样的文件夹，你面放着程序有关的信息 ldd ./1
                            可以看到 linux-vdso.so.1 (0x00007fff47eac000) libc.so.6 =&gt; /lib64/libc.so.6
                            (0x00007f37c4414000) /lib64/ld-


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
        <span>
            <span class="glyphicon glyphicon-calendar"></span>
            2015-05-07
        </span>
        <span>
            <span class="glyphicon glyphicon-comment"></span>
            5
        </span>
        <span>
            <span class="glyphicon glyphicon-eye-open"></span>
            1438
        </span>
            </div>
        </div>


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

                <h1><a href="/article/linux_program_study_note_18.html">linux 环境编程学习笔记 第25天 信号量(进程同步)</a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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

                        <p>一、信号量(进程同步) 模型 (1)创建或者得到信号量 semget int semget(key_t key, int nsems, //信号量数组的个数 int semflg);
                            ////信号量的创建标记 创建：IPC_CREAT IPC_EXCL(防止重复创建)，打开：就是0 (2)初始化信号量中指定下标的值 semctl int semctl(int
                            semid, int semnu


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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

                <h1><a href="/article/linux_program_study_note_17.html">linux 环境编程学习笔记 第24天 基于socket文件的IPC</a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_17.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>一、基于socket文件的IPC 两种模型： 对等模型 C/S模型 1. 对等模型 绑定 (1) 建立socker内核对象 socket函数 int socket(int domain,
                            地址族类型 AF_UNIX AF_INET int type, //指定数据存放的数据格式 流SOCK_STREAM（数据之间没有边界） / 报文SOCK_DGRAM（数据之间有边界）
                            int protoc


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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
            803
        </span>
            </div>
        </div>


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

                <h1><a href="/article/linux_program_study_note_16.html">linux 环境编程学习笔记 第22、23天 基于内存的通信 </a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_16.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>一、基于内存的通信 一组内核共享工具 ipcs 可以看到三段东西 Shared Memory Segments 共享内存 Semaphore Arrays 信号量数组，共享内存数组
                            Message Queues 共享消息队列 ipcrm 1.普通的父子进程之间的匿名内存共享映射 2.内核共享内存（无序） 编程模型： (1) 创建共享内存，得到一个ID
                            shmget函数 int shmget(


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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
            764
        </span>
            </div>
        </div>


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

                <h1><a href="/article/linux_program_study_note_15.html">linux 环境编程学习笔记 第21天 基于普通文件IPC,管道文件,匿名管道</a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_15.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>一、基于普通文件IPC IPC（Inter-Process Communication，进程间通信） 例子： main1.c 向tmp写入数据 #include #include
                            #include &lt;sys/mman.h&gt; int main(int argc, const char *argv[]) { int
                            fd=open("tmp",O_RDWR|O_CREAT|O_TRU


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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
            609
        </span>
            </div>
        </div>


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

                <h1><a href="/article/linux_program_study_note_14.html">linux 环境编程学习笔记 第20天 sigqueue/sigaction</a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_14.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>一、sigqueue/sigaction 1. 信号中断函数是否被其他信号中断？ 信号函数调用中只屏蔽本身信号，不屏蔽其他信号 例子： #include #include void
                            handle(int s) { printf("start!\n"); sleep(10); printf("end\n"); } int main(int argc, const
                            char *argv[]) {


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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
            875
        </span>
            </div>
        </div>


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

                <h1><a href="/article/linux_program_study_note_13.html">linux 环境编程学习笔记 第18、19天 信号(2)</a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_13.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>接着上上次 一、信号 3.信号的应用（实现多任务） 使用定时器实现多任务 例子：同时显示随机数与时间 #include #include #include #include
                            #include &lt;sys/time.h&gt; #include WINDOW *wtime,*wnumb; void showtime(int s) { time_t t;
                            struct tm *tt; tim


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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
            458
        </span>
            </div>
        </div>


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

                <h1><a href="/article/linux_program_study_note_12.html">linux 环境编程学习笔记 第16.17天 进程的基本控制,信号</a></h1>
        <span class="visible-xs-inline-block" style="margin-top:7px;">
            2015-05-07
        </span>

                <div class="post-tags">

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
                            <a href="/article/linux_program_study_note_12.html">
                                <img src="images/linux-article.jpg" height="400" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>

                        <p>一、进程的基本控制（进程的同步） 1.进程的常见控制函数 pause sleep/usleep atexit on_exit int atexit(void
                            (*function)(void)); //注册终止函数(即main执行结束后调用的函数) int on_exit(void (*function)(int , void *),
                            void *arg); //跟atexit差不多，只不过


                            ...

                        </p>
                    </div>
                </div>
            </div>
            <div class="post-info hidden-xs">
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
            575
        </span>
            </div>
        </div>


    </div>
    <!--分页 -->

    <ul class="pager">

        <li class="previous disabled">
            <a>&larr; 上一页</a>
        </li>

        <li class="page-number">1/3</li>

        <li class="next">
            <a href="?page=2">下一页 &rarr;</a>
        </li>

    </ul>

</div>

<div id="archives">
    <div id="topic-list">
        <div class="post-topic-area"> 动态</div>
        <div class="post-topic-form-result"></div>
        <div class="topics-wrapper">
            <div class="popup-group">
                <div class="topic-section-wrapper no-1 interview-section">
                    <div class="topic-section clearfix">
                        <div class="topic-detail">
                            <div class="topic-detail-inner" style="width:47%">
                                <div class="topic-reaction">
                                    <div class="reaction-section no-1">
                                        <div class="reaction-content">图赏</div>
                                    </div>
                                    <div class="comment-form-106-result"></div>
                                </div>
                                <div class="pic_show">
                                    <img src="{$photo['face']}" width="320">
                                </div>
                            </div>
                            <div class="topic-detail-inner" style="width:47%">
                                <div class="topic-reaction">
                                    <div class="reaction-section no-1">
                                        <div class="reaction-content"><span class="topic-add-comment"><a href="{:U('/Blog/Section/')}"
                                                                                                         target="_blank"><span>更多</span></a></span>最新
                                        </div>
                                    </div>
                                    <div class="comment-section-wrapper no-1">
                                        <div class="comment-section">

                                        </div>
                                    </div>

                                    <div class="comment-form-106-result"></div>
                                </div>

                                <ul>
                                    <?php foreach ($new as $k => $v) { ?>
                                        <li><span>{:date('y-m-d',$v['create_time'])}</span><a
                                                href="{:U('/Blog/Article/'.$v['id'])}" target="_blank">{$v['title']}</a></li>
                                    <?php } ?>
                                </ul>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- topic-section-wrapper -->

                <div class="topic-comment-87-result"></div>
                <div class="topic-87-result"></div>
            </div>

            <div class="myads">
            </div>
        </div>

        <div class="post-topic-area"> {$blog['name']}</div>
        <div class="post-topic-form-result"></div>
        <div class="topics-wrapper">
            <div class="popup-group">
                <div class="topic-section-wrapper no-1 interview-section">
                    <div class="topic-section clearfix">
                        <div class="topic-detail">
                            <?php $num = 1;
                            foreach ($blog['childList'] as $key1 => $value1) { ?>
                                <div class="topic-detail-inner" style="width:47%">
                                    <div class="topic-reaction">
                                        <div class="reaction-section no-1">
                                            <div class="reaction-content"><span class="topic-add-comment">
                                                            <a href="{:U('/Blog/Section/'.$value1['id'])}" target="_blank">
                                                                <span>更多</span></a></span>
                                                {$value1['name']}
                                            </div>
                                        </div>
                                        <div class="comment-section-wrapper no-1">
                                            <div class="comment-section">

                                            </div>
                                        </div>

                                        <div class="comment-form-106-result"></div>
                                    </div>

                                    <ul>
                                        <?php foreach ($value1['articleList'] as $key2 => $value2) { ?>
                                            <li><span>{:date('y-m-d',$value2['create_time'])}</span><a
                                                    href="{:U('/Blog/Article/'.$value2['id'])}" target="_blank">{$value2['title']}</a></li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <?php if ($num % 2 == 0) { ?>
                                    <div class="clearfix"></div>
                                <?php }
                                $num++; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- topic-section-wrapper -->

                <div class="topic-comment-87-result"></div>
                <div class="topic-87-result"></div>
            </div>

            <div class="myads">
            </div>
        </div>
    </div>
    <!-- archives -->
</div>
<?php require 'data/query.php'; ?>

<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.fduhole.com/img/icons/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://md-block.verou.me/md-block.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>茶楼学期总结报告</title>
</head>

<body>
<main class="swiper" id="page-swiper">
    <div class="swiper-wrapper container">
        <!--首页-->
        <section class="swiper-slide">
            <div style="margin: auto; width: 100%;">
                <br/>
                <div class="segment" id="title">
                    <b style="font-size: 25px">
                        茶楼年终总结报告
                    </b>
                    <p>
                        2024 秋学期<br/>（2024.6.30 - 2025.1.4）
                    </p>
                </div>

                <div class="segment">
                    <p style="text-align: center">随行昼夜长短的半轮变迁</p>
                    <p style="text-align: center">旦挞和你一起走过夏秋 来到冬天 等待春天</p>
                </div>
            </div>
            <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
        </section>

        <!-- 用户注册信息 -->
        <section class="swiper-slide">
            <div class="segment">
                <p>
                    您的用户ID是
                    <strong class="keyword">
                        <?php echo $user_id ?>
                    </strong>
                </p>
            </div>

            <div class="segment">
                <p>
                    <strong class="keyword">
                        <?php echo $user_info['joined_time'] ?>
                    </strong>
                    ，你注册了旦挞。
                </p>
                <p>
                    至今为止，旦挞已经陪伴你走过了
                    <strong class="keyword">
                        <?php echo $user_register_diff->format('%a') ?>
                    </strong>
                    个日日夜夜~
                </p>
                <?php if ($user_register_time > new DateTime('2022-6-30')): ?>
                    <p>新的一年，也请多指教喵</p>
                <?php else: ?>
                    <p>原来你是老茶友了！未来的路，让我们一起走下去喵</p>
                <?php endif; ?>
            </div>
            <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
        </section>

        <!-- 发帖信息 -->
        <section class="swiper-slide">
            <?php if ($total_hole_num['total'] > 0): ?>
                <div class="segment">
                    <p>
                        本学期的你，一共创建了
                        <strong class="keyword">
                            <?php echo $total_hole_num['total'] ?>
                        </strong>
                        个主题贴，使用
                        <strong class="keyword">
                            <?php echo $most_often_used_tag['name'] ?>
                        </strong>
                        tag 的帖子高达
                        <strong class="keyword">
                            <?php echo $most_often_used_tag['tag_num'] ?>
                        </strong>
                        个
                    </p>
                    <p>
                        其中，
                        <strong class="keyword">
                            #<?php echo $highest_reply_hole['hole_id'] ?>
                        </strong>
                        得到了
                        <strong class="keyword">
                            <?php echo $highest_reply_hole['reply'] ?>
                        </strong>
                        条回复，是讨论最热烈的主题帖！
                    </p>
                </div>

                <div class="segment">
                    <blockquote>
                        <div class="quote-card">
                            <div class="quote-header">
                                <div class="quote-id">
                                    #<?php echo $highest_reply_hole['hole_id'] ?>
                                </div>
                                <div class="quote-icon">
                                    <svg>
                                        <use xlink:href="#quote"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="quote-content">
                                <md-block>
                                    <?php echo $highest_reply_hole['content'] ?>
                                </md-block>
                            </div>
                        </div>
                    </blockquote>
                </div>

            <?php else: ?>
                <div class="segment">
                    <p>本学期的你在茶楼默默潜水</p>
                    <p>要不要来发个主题帖向大家 say hello 呢？</p>
                </div>
            <?php endif; ?>
            <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
        </section>

        <section class="swiper-slide">
            <?php if ($total_review_num['total'] > 0): ?>
                <div class="segment">
                    <p>
                        在蛋壳，本学期的你一共创建了
                        <strong class="keyword">
                            <?php echo $total_review_num['total'] ?>
                        </strong>
                        条课评
                    </p>
                    <p>你的月旦雅评，帮助选课的同学不再迷茫</p>
                </div>

            <?php else: ?>
                <div class="segment">
                    <p>赠人课评，手有余香，蛋壳期待你的课程体验分享</p>
                </div>
            <?php endif; ?>
            <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
        </section>

        <?php if ($total_reply_num['total'] > 0): ?>
            <!-- 回贴信息 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        这半年，你在
                        <strong class="keyword">
                            <?php echo $total_replied_hole_num['total'] ?>
                        </strong>
                        个帖里留下了自己的足迹，一共做出了
                        <strong class="keyword">
                            <?php echo $total_reply_num['total'] ?>
                        </strong>
                        条回复，你最常回复的 tag 是
                        <strong class="keyword">
                            <?php echo $most_often_replied_tag['name'] ?>
                        </strong>
                    </p>
                    <?php if ($total_reply_num['total'] > 50): ?>
                        <p>蓦然回首，茶楼里已处处有你的痕迹</p>
                    <?php else: ?>
                        <p>##后跳动的数字，也有你的一点一滴</p>
                    <?php endif; ?>
                    <p>2024年，茶楼上线表情包功能</p>
                    <p>半年来，
                        <strong class="keyword">
                            <?php echo $total_sticker_num['total'] ?>
                        </strong>
                        只可爱猫猫出现在你的回复中
                    </p>
                </div>

                <?php if ($highest_like_num): ?>
                    <div class="segment">
                        <p>
                            没想到吧，你获赞最高的发言是
                            <strong class="keyword">
                                ##<?php echo $highest_like_num['floor_id'] ?>
                            </strong>
                            ，一共有
                            <strong class="keyword">
                                <?php echo $highest_like_num['likes'] ?>
                            </strong>
                            个人给你点赞哦～
                        </p>

                        <blockquote>
                            <div class="quote-card">
                                <div class="quote-header">
                                    <div class="quote-id">
                                        ##<?php echo $highest_like_num['floor_id'] ?>
                                    </div>
                                    <div class="quote-icon">
                                        <svg>
                                            <use xlink:href="#quote"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="quote-content">
                                    <md-block>
                                        <?php echo $highest_like_num['content'] ?>
                                    </md-block>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                <?php else: ?>
                    <div class="segment">
                        <p>你没被点过赞呢～</p>
                        <p>再接再厉哦～</p>
                    </div>
                <?php endif; ?>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>

            <!-- 最关注的洞 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        你最关注的帖是
                        <strong class="keyword">
                            #<?php echo $most_focused_post['hole_id'] ?>
                        </strong>
                        ，并留下了共计
                        <strong class="keyword">
                            <?php echo $most_focused_post['reply'] ?>
                        </strong>
                        条回复！
                    </p>
                    <p>思维的火花</p>
                    <p>在热烈的讨论中绽放</p>
                    <p>（左右滑动查看更多回帖）</p>
                </div>
                <div class="segment">
                    <div class="swiper swiper-quote" id="hole-swiper">
                        <div class="swiper-wrapper">
                            <?php while ($row = $most_focused_post_content->fetch_assoc()) { ?>
                                <div class="swiper-slide">
                                    <blockquote>
                                        <div class="quote-card">
                                            <div class="quote-header">
                                                <div class="quote-id">
                                                    ##<?php echo $row['id'] ?>
                                                </div>
                                                <div class="quote-icon">
                                                    <svg>
                                                        <use xlink:href="#quote"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="quote-content quote-fixed-content">
                                                <md-block>
                                                    <?php echo $row['content'] ?>
                                                </md-block>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>

            <!-- 发帖最多的日期 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        <strong class="keyword">
                            <?php echo $most_reply_day['date'] ?>
                        </strong>
                        可能是个特别的日子……
                    </p>
                    <p>
                        这一天，你在树洞发送了
                        <strong class="keyword">
                            <?php echo $most_reply_day['reply'] ?>
                        </strong>
                        条帖子
                    </p>
                    <p>
                        这一天对你来说，是不是有什么特殊意义？
                    </p>
                    <p>（左右滑动查看更多回帖）</p>
                </div>
                <div class="segment">
                    <div class="swiper swiper-quote" id="hole-swiper">
                        <div class="swiper-wrapper">
                            <?php while ($row = $most_reply_day_content->fetch_assoc()) { ?>
                                <div class="swiper-slide">
                                    <blockquote>
                                        <div class="quote-card">
                                            <div class="quote-header">
                                                <div class="quote-id">
                                                    ##<?php echo $row['id'] ?>
                                                </div>
                                                <div class="quote-icon">
                                                    <svg>
                                                        <use xlink:href="#quote"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="quote-content quote-fixed-content">
                                                <md-block>
                                                    <?php echo $row['content'] ?>
                                                </md-block>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                chevron_left
            </span>
            </section>

            <!-- 发帖时间分布 -->
            <section class="swiper-slide">
                <div class="segment">
                    <?php if ($reply_count_midnight == $reply_count_time_max): ?>
                        <p>你最喜欢在<span class="keyword">深夜</span>发帖。万籁俱寂中，你悄然活跃于茶楼的各个角落</p>
                    <?php elseif ($reply_count_morning == $reply_count_time_max): ?>
                        <p>你最喜欢在<span class="keyword">上午</span>发帖。晨光中，你的身影在闪耀</p>
                    <?php elseif ($reply_count_afternoon == $reply_count_time_max): ?>
                        <p>你最喜欢在<span class="keyword">下午</span>发帖。茶楼陪伴着你，享受午间的阳光与温柔</p>
                    <?php else: ?>
                        <p>你最喜欢在<span class="keyword">夜幕降临</span>时发帖。在这里，你放下白天的奔波苦辛，与茶友们畅聊、欢聚
                        </p>
                    <?php endif; ?>
                </div>

                <div id="pie-chart-container">
                    <div id="pie-chart">
                        <canvas id="reply-time-chart"></canvas>
                        <p id="reply-midnight" hidden><?php echo $reply_count_midnight ?></p>
                        <p id="reply-morning" hidden><?php echo $reply_count_morning ?></p>
                        <p id="reply-afternoon" hidden><?php echo $reply_count_afternoon ?></p>
                        <p id="reply-evening" hidden><?php echo $reply_count_evening ?></p>
                    </div>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>

            <?php if ($latest_post): ?>
                <!-- 最晚的发帖 -->
                <section class="swiper-slide">
                    <div class="segment">
                        <p>
                            <strong class="keyword">
                                <?php echo $latest_post['date'] ?>
                            </strong>
                            这一天，你在茶楼流连到很晚
                        </p>

                        <p>
                            <strong class="keyword">
                                <?php
                                $latest_post_time = new DateTimeImmutable($latest_post['time']);
                                echo $latest_post_time->format('H:i');
                                ?>
                            </strong>
                            ，你还发了新帖
                            <strong class="keyword">
                                ##<?php echo $latest_post['id'] ?>
                            </strong>
                        </p>
                    </div>

                    <div class="segment">
                        <blockquote>
                            <div class="quote-card">
                                <div class="quote-header">
                                    <div class="quote-id">
                                        ##<?php echo $latest_post['id'] ?>
                                    </div>
                                    <div class="quote-icon">
                                        <svg>
                                            <use xlink:href="#quote"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="quote-content">
                                    <md-block>
                                        <?php echo $latest_post['content'] ?>
                                    </md-block>
                                </div>
                            </div>
                        </blockquote>
                    </div>

                    <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
                </section>
            <?php endif; ?>

        <?php else: ?>
            <!-- 没有发帖 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        这半年，你在
                        <strong class="keyword">0</strong>
                        个帖里留下了自己的足迹，一共做出了
                        <strong class="keyword">0</strong>
                        条回复，超过了
                        <strong class="keyword">0%</strong>
                        的茶友
                    </p>
                    <p>闷声发大财，原来说的就是你吗？</p>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>
        <?php endif; ?>

        <!-- 点赞与收藏 -->
        <section class="swiper-slide">
            <div class="segment">
                <p>
                    这学期，你一共收获了
                    <strong class="keyword">
                        <?php echo $total_like['likes'] ?>
                    </strong>
                    次点赞！
                </p>
                <p>每一次点赞，都是一份肯定与赞美</p>
                <p>今后也请多多产出哦！</p>
            </div>

            <div class="segment">
                <?php if ($total_like_others['likes'] > 0): ?>
                    <p>
                        同时，你给其他人点了
                        <strong class="keyword"><?php echo $total_like_others['likes'] ?></strong>
                        个赞！
                    </p>
                    <p>“我狠狠赞同了”</p>
                <?php else: ?>
                    <p>本学期你还没给其他人点过赞……</p>
                    <p>答应我，下次一定！</p>
                <?php endif; ?>
            </div>

            <div class="segment">
                <p>
                    你的帖子一共被收藏了
                    <strong class="keyword">
                        <?php echo $my_posts_favorited_count['total'] ?>
                    </strong>
                    次，被订阅了
                    <strong class="keyword">
                        <?php echo $my_posts_subscribed_count['total'] ?>
                    </strong>
                    次
                </p>
                <p>每一颗五角星背后，都有另一个人的默默期待</p>
            </div>
            <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
        </section>

        <?php if ($most_mentioned and $most_mentioned['count'] > 0): ?>
            <!-- 被引用最多的帖子 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        <strong class="keyword">
                            ##<?php echo $most_mentioned['id'] ?>
                        </strong>
                        是你被引用次数最多的内容，共被引用了
                        <strong class="keyword">
                            <?php echo $most_mentioned['count'] ?>
                        </strong>
                        次，还有印象吗？
                    </p>
                </div>

                <div class="segment">
                    <blockquote>
                        <div class="quote-card">
                            <div class="quote-header">
                                <div class="quote-id">
                                    ##<?php echo $most_mentioned['id'] ?>
                                </div>
                                <div class="quote-icon">
                                    <svg>
                                        <use xlink:href="#quote"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="quote-content">
                                <md-block>
                                    <?php echo $most_mentioned['content'] ?>
                                </md-block>
                            </div>
                        </div>
                    </blockquote>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>
        <?php endif; ?>

        <?php if ($most_replied_anonyname_in_a_hole and $most_replied_anonyname_in_a_hole['reply_times'] > 0): ?>
            <!-- 最常互动的匿名用户 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        或许，你还记得与这个用户
                        <strong class="keyword">
                            <?php echo $most_replied_anonyname_in_a_hole['anonyname'] ?>
                        </strong>
                        的对话吗？ta 在你的帖子
                        <strong class="keyword">
                            #<?php echo $most_replied_anonyname_in_a_hole['hole_id'] ?>
                        </strong>
                        中留下了
                        <strong class="keyword">
                            <?php echo $most_replied_anonyname_in_a_hole['reply_times'] ?>
                        </strong>
                        条回复
                        <br>
                        无论是温暖的互动，还是激烈的辩论，你们都为彼此留下了宝贵的记忆
                    </p>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>
        <?php endif; ?>

        <?php if ($report_num['total'] > 0): ?>
            <!-- 举报 -->
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        你热衷于参与社区管理，提交了
                        <strong class="keyword">
                            <?php echo $report_num['total'] ?>
                        </strong>
                        个举报，其中
                        <strong class="keyword">
                            <?php echo $report_delete_num['total'] ?>
                        </strong>
                        个得到了处理
                    </p>
                    <p>管理员说：感谢你的积极参与，未来也请一如既往</p>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>
        <?php endif; ?>

        <!-- 结语 -->
        <section class="swiper-slide">
            <div class="segment">
                <p>没有一个声音无人听见，</p>
                <p>没有一句话语不曾洞见真心。</p>
                <p>谨以此纪念过去的半年，</p>
                <p>并期待繁花盛开的春天。</p>
            </div>

            <div class="segment">
                <p>滑动翻开你的专属报告……</p>
            </div>
            <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
        </section>

        <!-- 个人专属报告 -->
        <section class="swiper-slide">
            <div id="report-card">
                <p id="report-title">
                    我与旦挞的2024秋季学期
                </p>

                <ul>
                    <li>发帖：<?php echo $total_hole_num['total'] ?></li>
                    <li>回复：<?php echo $total_reply_num['total'] ?></li>
                    <li>点赞：<?php echo $total_like_others['likes'] ?></li>
                    <li>被赞：<?php echo $total_like['likes'] ?></li>
                    <li>收藏：<?php echo $my_favorites_count['total'] ?></li>
                    <li>被收藏：<?php echo $my_posts_favorited_count['total'] ?></li>
                    <li>订阅：<?php echo $my_subscription_count['total'] ?></li>
                    <li>被订阅：<?php echo $my_posts_subscribed_count['total'] ?></li>
                    <li>回帖最多的日子：<?php echo $most_reply_day['date'] ?></li>
                </ul>

                <p id="report-tags">
                        <span class="special-tag">
                            <?php if ($user_register_time > new DateTime('2022-6-30')): ?>
                                初来乍到请多指教
                            <?php else: ?>
                                茶楼老客户
                            <?php endif; ?>
                        </span>

                    <span class="special-tag">
                            <?php if ($total_reply_num['total'] > 50): ?>
                                茶楼大水怪
                            <?php elseif ($total_reply_num['total'] > 0): ?>
                                喝茶爱好者
                            <?php else: ?>
                                潜水艇
                            <?php endif; ?>
                        </span>

                    <?php if ($total_like_others['likes'] > 0): ?>
                        <span class="special-tag">独具慧眼</span>
                    <?php endif; ?>

                    <?php if ($total_like['likes'] > 0): ?>
                        <span class="special-tag">被对上了电波</span>
                    <?php endif; ?>

                    <?php if ($total_reply_num['total'] > 0): ?>
                        <span class="special-tag">
                                <?php if ($reply_count_midnight == $reply_count_time_max): ?>
                                    凌晨三点我睁开了眼
                                <?php elseif ($reply_count_morning == $reply_count_time_max): ?>
                                    早起的鸟儿有茶喝
                                <?php elseif ($reply_count_afternoon == $reply_count_time_max): ?>
                                    在夕阳西下时造访茶楼
                                <?php else: ?>
                                    和夜幕一起降临
                                <?php endif; ?>
                            </span>
                    <?php endif; ?>

                    <?php if ($report_num['total'] > 0): ?>
                        <span class="special-tag">参与社区管理</span>
                    <?php endif; ?>

                    <?php if ($total_review_num['total'] > 0): ?>
                        <span class="special-tag">埋下一颗种子</span>
                    <?php endif; ?>

                    <?php if ($total_sticker_num['total'] > 0): ?>
                        <span class="special-tag">古希腊掌管旦挞猫猫的神</span>
                    <?php endif; ?>
                </p>
            </div>
        </section>
    </div>
</main>

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21.4941" height="13.5449"
     display="none">
    <symbol width="21" height="13" viewBox="0 0 24 24" id="quote">
        <g>
            <rect height="13.5449" opacity="0" width="21.4941" x="0" y="0"/>
            <path d="M0 4.70703C0 7.30469 1.93359 9.375 4.4043 9.375C5.56641 9.375 6.66992 8.91602 7.48047 8.01758L7.74414 8.01758C7.17773 9.86328 5.45898 11.4062 3.33008 12.041C3.01758 12.1387 2.79297 12.2266 2.65625 12.3438C2.5 12.4707 2.42188 12.627 2.42188 12.8516C2.42188 13.2617 2.72461 13.5449 3.17383 13.5449C3.49609 13.5449 3.7207 13.4863 4.15039 13.3496C5.48828 12.9102 6.70898 12.1387 7.64648 11.1523C8.95508 9.78516 9.76562 7.95898 9.76562 5.79102C9.76562 2.12891 7.44141 0.00976562 4.7168 0.00976562C2.03125 0.00976562 0 2.06055 0 4.70703ZM11.7285 4.70703C11.7285 7.30469 13.6523 9.375 16.1328 9.375C17.2949 9.375 18.3887 8.91602 19.209 8.01758L19.4629 8.01758C18.9062 9.86328 17.1875 11.4062 15.0488 12.041C14.7363 12.1387 14.5215 12.2266 14.3848 12.3438C14.2285 12.4707 14.1406 12.627 14.1406 12.8516C14.1406 13.2617 14.4531 13.5449 14.9121 13.5449C15.2148 13.5449 15.4492 13.4863 15.8691 13.3496C17.2168 12.9102 18.4277 12.1387 19.3555 11.1523C20.6836 9.78516 21.4941 7.95898 21.4941 5.79102C21.4941 2.12891 19.1699 0.00976562 16.4453 0.00976562C13.7598 0.00976562 11.7285 2.06055 11.7285 4.70703Z"/>
        </g>
    </symbol>
</svg>
<script src="swiper.js"></script>
</body>
<?php require 'query.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.fduhole.com/img/icons/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://md-block.verou.me/md-block.js" defer></script>
    <title>FDUHole年终总结报告</title>
</head>

<body>
    <main class="swiper" id="page-swiper">
        <div class="swiper-wrapper container">
            <!--首页-->
            <section class="swiper-slide">
                <div style="margin: auto; width: 100%;">
                    <img id="logo" src="https://danxi.fduhole.com/assets/webhole-favicon.c6298a3d.svg">
                    <br />
                    <div class="segment" id="title">
                        <b style="font-size: 25px">
                            FDUHole年终总结报告
                        </b>
                        <p>
                            2022 秋学期（2022.8.28 - 2023.1.7）
                        </p>
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
                        ，你注册了FDUHole。
                    </p>
                    <p>
                        至今为止，FDUHole已经陪伴你走过了
                        <strong class="keyword">
                            <?php echo $user_register_diff->format('%a') ?>
                        </strong>
                        个日日夜夜~
                    </p>
                    <?php if ($user_register_time > new DateTime('2022-6-30')): ?>
                        <p>新的一年，也请多指教喵</p>
                    <?php else: ?>
                        <p>原来你是FDUHole老用户了！未来的路，让我们一起走下去喵</p>
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
                        个洞
                    </p>
                    <p>
                        其中，
                        <strong class="keyword">
                            #<?php echo $highest_reply_hole['id'] ?>
                        </strong>
                        得到了
                        <strong class="keyword">
                            <?php echo $highest_reply_hole['reply'] ?>
                        </strong>
                        条回复，是其中讨论最热烈的主题帖！
                    </p>
                </div>

                <div class="segment">
                    <blockquote>
                        <div class="quote-card">
                            <div class="quote-header">
                                <div class="quote-id">
                                    #<?php echo $highest_reply_hole['id'] ?>
                                </div>
                                <div class="quote-icon">
                                    <svg>
                                        <use xlink:href="#quote" />
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
                    <p>本学期的你在树洞默默潜水</p>
                    <p>要不要来发个主题帖向大家 say hello 呢？</p>
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
                        个洞里留下了自己的足迹，一共做出了
                        <strong class="keyword">
                            <?php echo $total_reply_num['total'] ?>
                        </strong>
                        条回复
                    </p>
                    <?php if ($total_reply_num['total'] > 50): ?>
                        <p>蓦然回首，树洞里已处处有你的痕迹</p>
                    <?php else: ?>
                        <p>##后跳动的数字，也有你的一点一滴</p>
                    <?php endif; ?>
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
                                        <use xlink:href="#quote" />
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

            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        你最关注的洞是
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
                                                        <use xlink:href="#quote" />
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
                            <?php }; ?>
                        </div>
                    </div>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>

            <!-- 日期与时间 -->
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
                                                        <use xlink:href="#quote" />
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
                            <?php }; ?>
                        </div>
                    </div>
                </div>
                <span class="material-symbols-outlined" id="indicator">
                    chevron_left
                </span>
            </section>
            <?php else: ?>
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        这半年，你在
                        <strong class="keyword">0</strong>
                        个洞里留下了自己的足迹，一共做出了
                        <strong class="keyword">0</strong>
                        条回复，超过了
                        <strong class="keyword">0%</strong>
                        的洞友
                    </p>
                    <p>原来传说中的潜水员就是你吗？</p>
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
                            <?php echo $highest_fav_num['total'] ?>
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
                                        <use xlink:href="#quote" />
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

            <?php if ($report_num['total'] > 0): ?>
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
            </section>
            <?php endif; ?>
        </div>
    </main>

    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21.4941" height="13.5449" display="none">
        <symbol width="21" height="13" viewBox="0 0 24 24" id="quote">
            <g>
                <rect height="13.5449" opacity="0" width="21.4941" x="0" y="0" />
                <path d="M0 4.70703C0 7.30469 1.93359 9.375 4.4043 9.375C5.56641 9.375 6.66992 8.91602 7.48047 8.01758L7.74414 8.01758C7.17773 9.86328 5.45898 11.4062 3.33008 12.041C3.01758 12.1387 2.79297 12.2266 2.65625 12.3438C2.5 12.4707 2.42188 12.627 2.42188 12.8516C2.42188 13.2617 2.72461 13.5449 3.17383 13.5449C3.49609 13.5449 3.7207 13.4863 4.15039 13.3496C5.48828 12.9102 6.70898 12.1387 7.64648 11.1523C8.95508 9.78516 9.76562 7.95898 9.76562 5.79102C9.76562 2.12891 7.44141 0.00976562 4.7168 0.00976562C2.03125 0.00976562 0 2.06055 0 4.70703ZM11.7285 4.70703C11.7285 7.30469 13.6523 9.375 16.1328 9.375C17.2949 9.375 18.3887 8.91602 19.209 8.01758L19.4629 8.01758C18.9062 9.86328 17.1875 11.4062 15.0488 12.041C14.7363 12.1387 14.5215 12.2266 14.3848 12.3438C14.2285 12.4707 14.1406 12.627 14.1406 12.8516C14.1406 13.2617 14.4531 13.5449 14.9121 13.5449C15.2148 13.5449 15.4492 13.4863 15.8691 13.3496C17.2168 12.9102 18.4277 12.1387 19.3555 11.1523C20.6836 9.78516 21.4941 7.95898 21.4941 5.79102C21.4941 2.12891 19.1699 0.00976562 16.4453 0.00976562C13.7598 0.00976562 11.7285 2.06055 11.7285 4.70703Z" />
            </g>
        </symbol>
    </svg>
    <script src="swiper.js"></script>
</body>
<?php require 'query.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.fduhole.com/img/icons/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script type="module" src="https://md-block.verou.me/md-block.js" defer></script>
    <title>旦夕年终总结报告</title>
</head>

<body>
    <main class="swiper">
        <div class="swiper-wrapper container">
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
                            某年某月某日
                        </strong>
                        ，你注册了旦夕。
                    </p>
                    <p>
                        至今为止，旦夕已经陪伴你走过了
                        <strong class="keyword">
                            XXX
                        </strong>
                        个日日夜夜~
                    </p>
                    <p>原来你是旦夕老用户了！未来的路，让我们一起走下去喵</p>
                </div>
            </section>

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
                    <md-block>
                        <?php echo $highest_reply_hole['content'] ?>
                    </md-block>
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
                <?php else: ?>
                <div class="segment">
                    <p>本学期的你在树洞默默潜水</p>
                    <p>要不要来发个主题帖向大家 say hello 呢？</p>
                </div>
                <?php endif; ?>
            </section>
        
            <?php if ($total_reply_num['total'] > 0): ?>
            <section class="swiper-slide">
                <div class="segment">
                    <p>
                        这半年，你在
                        <strong class="keyword">TODO</strong>
                        个洞里留下了自己的足迹
                    </p>
                    <p>
                        蓦然回首，树洞里已处处有你的痕迹 // TODO
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
                        <md-block>
                            <?php echo $highest_like_num['content'] ?>
                        </md-block>
                    </blockquote>
                </div>
                <?php else: ?>
                <div class="segment">
                    <p>你没被点过赞呢～</p>
                    <p>再接再厉哦～</p>
                </div>
                <?php endif; ?>
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
                    </p>
                    <p>思维的火花</p>
                    <p>在热烈的讨论中绽放</p>
                </div>
            </section>

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
                </div>
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
            </section>
            <?php endif; ?>

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
        </div>
    </main>
    <script src="swiper.js"></script>
</body>
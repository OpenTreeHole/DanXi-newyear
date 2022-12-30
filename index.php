<?php
require 'query.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.fduhole.com/img/icons/favicon-16x16.png">
    <title>旦夕年终总结报告</title>
</head>
<body>

<h1>树洞年终总结报告</h1>

<p>您的用户ID是<?php echo $user_id?>

<?php if ($total_hole_num['total'] > 0): ?>
    <p>
        本学期的你，
        一共创建了<?php echo $total_hole_num['total']?>个洞
        其中<?php echo $total_hole_reply_num['total']?>个收到了其他洞友的回复。
    </p>
    <p>
        其中，获得回复最多的洞是#<?php echo $highest_reply_hole['id']?>，
        共<?php echo $highest_reply_hole['reply']?>，内容为：
    </p>
    <p>
        <?php echo $highest_reply_hole['content']?>
    </p>

    <p>帖子被收藏数：<?php echo $highest_fav_num['total']?></p>
<?php else: ?>
    <p>你没发帖</p>
<?php endif; ?>

<?php if ($total_reply_num['total'] > 0): ?>
    <p>总共的回帖数量为：<?php echo $total_reply_num['total']?></p>

    <p>最高点赞为##<?php echo $highest_like_num['floor_id']?>，点赞数为：<?php echo $highest_like_num['likes'] ?>，内容为：</p>
    
    <p>
        <?php echo $highest_like_num['content']?>
    </p>
<?php else: ?>
    <p>你没回贴</p>
<?php endif; ?>

<p>
你一共举报了<?php echo $report_num['total']?>次，
其中<?php echo $report_delete_num['total']?>帖子个被删了
</p>




</body>
<?php

require 'connect_db.php';

if (getenv("MODE") == "PRODUCTION") {
    if (!array_key_exists('HTTP_X_CONSUMER_USERNAME', $_SERVER) ||
        (array_key_exists('HTTP_X_ANONYMOUS_CONSUMER', $_SERVER) && $_SERVER['HTTP_X_ANONYMOUS_CONSUMER'] == 'true')) { // not authorized
        header('Location: ' . getenv('AUTH_URL'), true, 302); // redirect to login page
        exit;
    }
    $user_id = intval($_SERVER['HTTP_X_CONSUMER_USERNAME']);
} else {
    $user_id = $_GET["user"];
}

function query_one($sql)
{
    global $conn, $user_id;
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $user_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

function query_auth_one($sql)
{
    global $auth_conn, $user_id;
    $statement = $auth_conn->prepare($sql);
    $statement->bind_param('i', $user_id);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc();
}

$user_info = query_auth_one(
    "SELECT DATE(joined_time) AS joined_time
FROM user
WHERE id = ?;");

$user_register_time = new DateTimeImmutable($user_info['joined_time']);
$user_register_diff = (new DateTime())->diff($user_register_time);


$total_hole_num = query_one(
    "SELECT COUNT(*) AS total
FROM hole 
WHERE user_id = ?
  AND created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$total_hole_reply_num = query_one(
    "SELECT COUNT(*) AS total
FROM hole 
WHERE user_id = ?
  AND reply > 0
  AND created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$highest_reply_hole = query_one(
    "SELECT hole.id, reply, content
FROM hole JOIN floor ON hole.id = floor.hole_id
WHERE hole.user_id = ?
  AND hole.created_at BETWEEN '2022-6-26' AND '2023-01-07'
ORDER BY reply DESC, floor.id
LIMIT 1;");

$total_reply_num = query_one(
    "SELECT COUNT(*) AS total
FROM floor
WHERE user_id = ?
  AND created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$highest_fav_num = query_one(
    "SELECT COUNT(*) AS total
FROM hole JOIN user_favorites
ON hole.id = user_favorites.hole_id
WHERE hole.user_id = ?
  AND hole.created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$highest_like_num = query_one(
    "SELECT floor_id, SUM(like_data) AS likes, content
FROM floor_like JOIN floor
ON floor_like.floor_id = floor.id
WHERE floor.user_id = ?
  AND floor.created_at BETWEEN '2022-6-26' AND '2023-01-07'
GROUP BY floor_id
ORDER BY likes DESC
LIMIT 1;");

$report_num = query_one(
    "SELECT COUNT(*) AS total
FROM report
WHERE user_id = ?
AND created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$report_delete_num = query_one(
    "SELECT COUNT(DISTINCT floor.id) AS total
FROM report JOIN floor ON floor.id = report.floor_id
WHERE floor.deleted = true
  AND report.user_id = ?
  AND report.created_at BETWEEN '2022-6-26' AND '2023-01-07';");


$most_focused_post = query_one(
    "SELECT hole_id, COUNT(id) AS reply
FROM floor
WHERE user_id = ?
  AND created_at BETWEEN '2022-6-26' AND '2023-01-07'
  AND NOT deleted
GROUP BY hole_id
ORDER BY reply DESC
LIMIT 1;");

$most_focused_post_content = false;
if ($most_focused_post != false) {
    $statement = $conn->prepare("
    SELECT id, content
    FROM floor
    WHERE hole_id = ? AND user_id = ? AND NOT deleted;");
    $statement->bind_param('ii', $most_focused_post['hole_id'], $user_id);
    $statement->execute();
    $most_focused_post_content = $statement->get_result();
}

$most_reply_day = query_one(
    "SELECT DATE(DATE_ADD(created_at, INTERVAL 8 HOUR)) AS date, COUNT(*) as reply
FROM floor
WHERE user_id = ?
  AND created_at BETWEEN '2022-6-26' AND '2023-01-07'
  AND NOT deleted
GROUP BY date
ORDER BY reply DESC
LIMIT 1;");

$most_reply_day_content = false;
if ($most_reply_day != false) {
    $statement = $conn->prepare("
    SELECT id, content
    FROM floor
    WHERE DATE(DATE_ADD(created_at, INTERVAL 8 HOUR)) = ?
      AND NOT deleted
      AND user_id = ?;");
    $statement->bind_param('si', $most_reply_day['date'], $user_id);
    $statement->execute();
    $most_reply_day_content = $statement->get_result();
}

$total_like = query_one(
    "SELECT SUM(like_data) AS likes
FROM floor_like JOIN floor ON floor_like.floor_id = floor.id
WHERE floor.user_id = ?
  AND floor.created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$total_like_others = query_one("
SELECT COUNT(floor_like.floor_id) AS likes
FROM floor_like JOIN floor ON floor_like.floor_id = floor.id
WHERE floor_like.user_id = ?
AND floor.created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$total_replied_hole_num = query_one(
    "SELECT COUNT(DISTINCT hole_id) AS total
FROM floor
WHERE user_id = ?
  AND created_at BETWEEN '2022-6-26' AND '2023-01-07';");

$most_mentioned = query_one(
    "SELECT floor.id, content, COUNT(floor_mention.floor_id) AS count
FROM floor JOIN floor_mention ON floor.id = floor_mention.mention_id
WHERE floor.user_id = ?
  AND floor.created_at BETWEEN '2022-6-26' AND '2023-01-07'
GROUP BY floor_mention.mention_id
ORDER BY count DESC
LIMIT 1;");

function query_reply_count_time($begin, $end)
{
    global $conn, $user_id;
    $statement = $conn->prepare("SELECT COUNT(id) AS total
                                        FROM floor
                                        WHERE user_id = ?
                                          AND created_at BETWEEN '2022-6-26' AND '2023-01-07'
                                          AND TIME(DATE_ADD(created_at, INTERVAL 8 HOUR)) BETWEEN ? AND ?;");
    $statement->bind_param('iss', $user_id, $begin, $end);
    $statement->execute();
    $result = $statement->get_result();
    return $result->fetch_assoc()['total'];
}

$reply_count_midnight = query_reply_count_time('00:00:00', '05:59:59');
$reply_count_morning = query_reply_count_time('06:00:00', '11:59:59');
$reply_count_afternoon = query_reply_count_time('12:00:00', '17:59:59');
$reply_count_evening = query_reply_count_time('18:00:00', '23:59:59');
$reply_count_time_max = max($reply_count_midnight, $reply_count_morning, $reply_count_afternoon, $reply_count_evening);

$latest_post = query_one(
    "SELECT DATE(DATE_ADD(created_at, INTERVAL 8 HOUR)) AS date,
       TIME(DATE_ADD(created_at, INTERVAL 8 HOUR)) AS time,
       id, content
FROM floor
WHERE user_id = ?
  AND DATE_ADD(created_at, INTERVAL 8 HOUR) BETWEEN '2022-6-26' AND '2023-01-07'
  AND TIME(DATE_ADD(created_at, INTERVAL 8 HOUR)) BETWEEN '00:00:00' AND '05:00:00'
ORDER BY TIME(DATE_ADD(created_at, INTERVAL 8 HOUR)) DESC
LIMIT 1;");

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

function query_danke_one($sql)
{
    global $danke_conn, $user_id;
    $statement = $danke_conn->prepare($sql);
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
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$total_hole_reply_num = query_one(
    "SELECT COUNT(*) AS total
FROM hole 
WHERE user_id = ?
  AND reply > 0
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$highest_reply_hole = query_one(
    "SELECT hole_id, MAX(ranking) AS reply, content
FROM floor
WHERE hole_id IN (
    SELECT id
    FROM hole
    WHERE user_id = ?
      AND deleted_at IS NULL
      AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
)
GROUP BY hole_id
ORDER BY reply DESC LIMIT 1;");

$total_reply_num = query_one(
    "SELECT COUNT(*) AS total
FROM floor
WHERE user_id = ?
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$my_posts_favorited_count = query_one(
    "SELECT COUNT(*) AS total
FROM user_favorites
WHERE hole_id IN (
    SELECT id
    FROM hole
    WHERE user_id = ?
      AND deleted_at IS NOT NULL
      AND hidden = FALSE
      AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04') LIMIT 1;");

$my_posts_subscribed_count = query_one(
    "SELECT COUNT(*) AS total
FROM user_subscription
WHERE hole_id IN (
    SELECT id
    FROM hole
    WHERE user_id = ?
      AND deleted_at IS NOT NULL
      AND hidden = FALSE
      AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04') LIMIT 1;");

$my_favorites_count = query_one(
  "SELECT COUNT(hole_id) AS total
  FROM user_favorites 
  WHERE user_id = ? 
    AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
    LIMIT 1"
);

$my_subscription_count = query_one(
  "SELECT COUNT(hole_id) AS total
  FROM user_subscription 
  WHERE user_id = ? 
    AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
  LIMIT 1"
);

$highest_like_num = query_one(
    "SELECT floor_id, COUNT(*) AS likes, content
FROM floor_like
JOIN (
    SELECT id, content
    FROM floor
    WHERE floor.user_id = ?
      AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
) AS new_floor
    ON floor_like.floor_id = new_floor.id
WHERE like_data = 1
GROUP BY floor_id
ORDER BY likes DESC
LIMIT 1;");

$total_review_num = query_danke_one(
  "SELECT count(*) AS total 
  FROM review WHERE reviewer_id = ?
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$total_sticker_num = query_one(
  "SELECT SUM((LENGTH(content) - LENGTH(REPLACE(content, '![](dx_', ''))) / LENGTH('![](dx_')) AS total
  FROM floor
  WHERE user_id = ? AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$report_num = query_one(
    "SELECT COUNT(*) AS total
FROM report
WHERE user_id = ?
AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$report_delete_num = query_one(
    "SELECT COUNT(DISTINCT floor.id) AS total
FROM report JOIN floor ON floor.id = report.floor_id
WHERE floor.deleted = true
  AND report.user_id = ?
  AND DATE(report.created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");


$most_focused_post = query_one(
    "SELECT hole_id, COUNT(id) AS reply
FROM floor
WHERE user_id = ?
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04'
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
    "SELECT DATE(created_at) AS date, COUNT(*) as reply
FROM floor
WHERE user_id = ?
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04'
  AND NOT deleted
GROUP BY date
ORDER BY reply DESC
LIMIT 1;");

$most_reply_day_content = false;
if ($most_reply_day != false) {
    $statement = $conn->prepare("
    SELECT id, content
    FROM floor
    WHERE DATE(created_at) = ?
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
  AND DATE(floor.created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$total_like_others = query_one(
  "SELECT COUNT(floor_like.floor_id) AS likes
FROM floor_like JOIN floor ON floor_like.floor_id = floor.id
WHERE floor_like.user_id = ?
AND DATE(floor.created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$total_replied_hole_num = query_one(
    "SELECT COUNT(DISTINCT hole_id) AS total
FROM floor
WHERE user_id = ?
  AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04' LIMIT 1;");

$most_mentioned = query_one(
  "SELECT new_floor.id, content, COUNT(floor_mention.floor_id) AS count
  FROM floor_mention
  JOIN (
      SELECT id, content
      FROM floor
      WHERE user_id = ?
        AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
  ) AS new_floor
  ON floor_mention.mention_id = new_floor.id
  GROUP BY floor_mention.mention_id
  ORDER BY count DESC
  LIMIT 1;"
);

function query_reply_count_time($begin, $end)
{
    global $conn, $user_id;
    $statement = $conn->prepare("SELECT COUNT(id) AS total
                                        FROM floor
                                        WHERE user_id = ?
                                          AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04'
                                          AND TIME(created_at) BETWEEN ? AND ?;");
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
  "SELECT DATE(created_at) AS date,
          TIME(created_at) AS time,
          id,
          content
  FROM floor
  WHERE user_id = ?
    AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
    AND (
        (TIME(created_at) < '05:00:00')
        OR
        (TIME(created_at) >= '05:00:00' AND NOT EXISTS (
            SELECT 1
            FROM floor
            WHERE user_id = ?
              AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
              AND TIME(created_at) < '05:00:00'
        ))
    )
  ORDER BY TIME(created_at) DESC
  LIMIT 1;"
);

$earliest_post = query_one(
  "SELECT DATE(created_at) AS date,
          TIME(created_at) AS time,
          id,
          content
  FROM floor
  WHERE user_id = ?
    AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04'
    AND TIME(created_at) > '05:00:00'
  ORDER BY TIME(created_at)
  LIMIT 1;");

$most_often_used_tag = query_one(
    "SELECT
    ht.tag_id,
    t.name,
    COUNT(*) AS tag_num
FROM hole_tags AS ht
         JOIN (
    SELECT id
    FROM hole
    WHERE user_id = ?
      AND deleted_at IS NULL
      AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04'
) AS h_filtered
              ON ht.hole_id = h_filtered.id
         JOIN tag AS t
              ON ht.tag_id = t.id
GROUP BY ht.tag_id, t.name
ORDER BY tag_num DESC LIMIT 1;");

$most_often_replied_tag = query_one(
    "SELECT
    ht.tag_id,
    t.name,
    COUNT(*) AS tag_num
FROM hole_tags AS ht
         JOIN (
    SELECT hole_id
    FROM floor
    WHERE user_id = ?
      AND DATE(created_at) BETWEEN '2024-6-30' AND '2025-01-04'
) AS h_filtered
              ON ht.hole_id = h_filtered.hole_id
         JOIN tag AS t
              ON ht.tag_id = t.id
GROUP BY ht.tag_id, t.name
ORDER BY tag_num DESC LIMIT 1;");

$most_replied_anonyname_in_a_hole = query_one(
  "SELECT COUNT(*) AS reply_times, hole_id, anonyname
  FROM floor
  WHERE hole_id IN (
      SELECT id
      FROM hole
      WHERE user_id = ?
        AND deleted_at IS NULL
        AND hidden = FALSE
        AND DATE(created_at) BETWEEN '2024-06-30' AND '2025-01-04'
  )
    AND user_id != ?
  GROUP BY hole_id, anonyname
  ORDER BY reply_times DESC
  LIMIT 1;"
);
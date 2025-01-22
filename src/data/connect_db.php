<?php

$conn = new mysqli(getenv("DB_HOST"),
    getenv("DB_USER"),
    getenv("DB_PASSWORD"),
    "fduhole");
if ($conn->connect_error) {
    die("连接数据库失败");
}

$auth_conn = new mysqli(getenv("AUTH_DB_HOST"),
    getenv("AUTH_DB_USER"),
    getenv("AUTH_DB_PASSWORD"),
    "auth");
if ($auth_conn->connect_error) {
    die("连接数据库失败");
}

$danke_conn = new mysqli(getenv("DANKE_DB_HOST"),
    getenv("DANKE_DB_USER"),
    getenv("DANKE_DB_PASSWORD"),
    "danke");
if ($danke_conn->connect_error) {
    die("连接数据库失败");
}

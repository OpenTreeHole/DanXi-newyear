<?php

$conn = new mysqli(getenv("DB_HOST"),
    getenv("DB_USER"),
    getenv("DB_PASSWORD"),
    "fduhole");
if ($conn->connect_error) {
    die("连接数据库失败");
}

$auth_conn = new mysqli(getenv("DB_HOST"),
    getenv("DB_USER"),
    getenv("DB_PASSWORD"),
    "auth");

if ($auth_conn->connect_error) {
    die("连接数据库失败");
}
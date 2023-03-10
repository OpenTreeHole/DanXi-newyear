# 树洞年终总结报告

## 运行

在运行 Docker 镜像时需要使用 `-e` 或 `--env-file` 参数设置环境变量：
- 树洞数据库凭据：`DB_HOST, DB_USER, DB_PASSWORD`
- 用户数据库凭据：`AUTH_DB_HOST, AUTH_DB_USER, AUTH_DB_PASSWORD`
- 登录跳转 URL：`AUTH_URL`，格式为 `https://auth.fduhole.com/login?url=[URL Encoded Deploy Site URL]`

## 说明

### PHP 代码

`connect_db.php` 建立数据库连接，
`query.php` 执行 SQL 查询并将查询结果存放在变量中。

### 页面结构

每个页面包含在一个 `section.swiper-slide` 中。

每个页面分成若干个 `div.segment`，为一个段落。

每个段落中分为若干句话（`p`），文本里的强调用 `strong.keyword`表示。

引用用户帖子的内容是引用卡片，在 `blockquote` 元素中。

### 前端样式说明

样式代码在 `style.css` 中，主要包括
通用样式、
引用卡片样式、
Swiper 样式。

### 前端使用的库

滑动翻页效果使用了 [SwiperJS](https://swiperjs.com) 库，可以参考 [官方示例](https://swiperjs.com/demos)。

Markdown 渲染使用了 [md-block](https://md-block.verou.me)，页面中的 `md-block` 标签即为 Markdown 内容。

饼图使用了 [ChartJS](https://www.chartjs.org)，参考 [文档说明](https://www.chartjs.org/docs/latest/charts/doughnut.html)。
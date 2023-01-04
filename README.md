# 树洞年终总结报告

## 运行

请在团队内向相关人员索取测试服访问凭据，替换下方内容。
```shell
export DB_HOST=xxx DB_USER=xxx DB_PASSWORD=xxx
php -S localhost:8080
```

## 说明

### 待完成的工作
- [ ] 调整背景图片、颜色设计
- [ ] 增加封面、封底页面
- [ ] 增加分享功能

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
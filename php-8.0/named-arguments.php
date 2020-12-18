<?php

// 命名参数

// php 7
$string = '<a href="https://imiphp.com>imi 框架</a>';
$ret = htmlspecialchars($string, ENT_COMPAT | ENT_HTML401, 'UTF-8', false);
var_dump($ret);

// php 8
// 不用挨个传参, 指定参数名来传
$ret = htmlspecialchars($string, double_encode: false);
var_dump($ret);

// Out
// string(59) "&lt;a href=&quot;https://imiphp.com&gt;imi 框架&lt;/a&gt;"
// string(59) "&lt;a href=&quot;https://imiphp.com&gt;imi 框架&lt;/a&gt;"


// PHP 8.0 专题页给出的结语:
// 仅仅指定必填参数，跳过可选参数。
// 参数的顺序无关、自己就是文档（self-documented）

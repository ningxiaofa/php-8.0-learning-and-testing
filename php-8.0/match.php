<?php

/**
 * match 表达式
 */

// PHP 7
switch (8.0) {
  case '8.0':
    $result = "Oh no!";
    break;
  case 8.0:
    $result = "This is what I expected";
    break;
}
echo $result . PHP_EOL;
//> Oh no!

// PHP 8
echo match (8.0) {
  '8.0' => "Oh no!",
  8.0 => "This is what I expected",
} . PHP_EOL;
//> This is what I expected

// Out:
// Oh no!
// This is what I expected


// PHP 8.0 专题页给出的结语:
// 新的 match 类似于 switch，并具有以下功能：
// Match 是一个表达式，它可以储存到变量中亦可以直接返回。
// Match 分支仅支持单行，它不需要一个 break; 语句。
// Match 使用严格比较。

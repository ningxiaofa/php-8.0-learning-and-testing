<?php

/**
 * 字符串与数字的比较更符合逻辑
 */

// PHP 7, 需要切换到php7版本执行
// var_dump(0 == 'foobar'); // true

// PHP 8
var_dump(0 == 'foobar'); // false

// Out:
// bool(false)
// 可以看到, 这个改变存在一定的版本兼容问题, 但个人持支持态度.


// PHP 8.0 专题页给出的结语:
// PHP 8 比较数字字符串（numeric string）时，会按数字进行比较。 不是数字字符串时，将数字转化为字符串，按字符串比较。

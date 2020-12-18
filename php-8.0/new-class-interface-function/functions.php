<?php

/**
 * for detail:
https://wiki.php.net/rfc/str_contains // str_contains()
https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions // str_starts_with()
https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions // str_ends_with()
https://github.com/php/php-src/pull/4769 // fdiv()
https://wiki.php.net/rfc/get_debug_type // get_debug_type()
https://github.com/php/php-src/pull/5427 // get_resource_id()
https://wiki.php.net/rfc/token_as_object // token_get_all() 对象实现
*/

// 是否包含xxx字符串
var_dump(str_contains('imi 世界上最好的 swool 框架', 'imi'));
var_dump(str_contains('imi 世界上最好的 swool 框架', 'laravel'));

// 以xxx开头
var_dump(str_starts_with('imi 世界上最好的 swool 框架', 'imi'));
var_dump(str_starts_with('imi 世界上最好的 swool 框架', 'laravel'));

// 以xxx结尾
var_dump(str_ends_with('imi 世界上最好的 swool 框架', '框架'));
var_dump(str_ends_with('imi 世界上最好的 swool 框架', 'laravel'));

// 做浮点数除法
var_dump(fdiv(250, 2.5));
var_dump(fdiv(250, 25));

// 获取值类型
var_dump(get_debug_type(1));
var_dump(get_debug_type(1.0));
var_dump(get_debug_type("1"));
var_dump(get_debug_type(true));
var_dump(get_debug_type(null));
var_dump(get_debug_type([]));
var_dump(get_debug_type(new \stdClass));

// 获取资源的id
$fp = fopen(__FILE__, 'r');
var_dump('resource_id: ' . get_resource_id($fp));
fclose($fp);

$fp = fopen(__DIR__ . '/stringable.php', 'r');
var_dump('resource_id: ' . get_resource_id($fp));
fclose($fp);

// Out:
// bool(true)
// bool(false)
// bool(true)
// bool(false)
// bool(true)
// bool(false)
// float(100)
// float(10)
// string(3) "int"
// string(5) "float"
// string(6) "string"
// string(4) "bool"
// string(4) "null"
// string(5) "array"
// string(8) "stdClass"
// string(14) "resource_id: 5"
// string(14) "resource_id: 6"

// Note:
// 上面有些函数, PHP 框架中多有实现, 但是现在 PHP 自身开始支持, 更加方便, 而且性能更好.

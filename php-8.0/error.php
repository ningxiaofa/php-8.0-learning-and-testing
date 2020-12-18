<?php

/**
 * 内部函数类型错误的一致性
 */
// PHP 7: 需要切换到 php7 版本下执行
// strlen([]); // Warning: strlen() expects parameter 1 to be string, array given
// array_chunk([], -1); // Warning: array_chunk(): Size parameter expected to be greater than 0


// PHP 8
strlen([]); // TypeError: strlen(): Argument #1 ($str) must be of type string, array given
array_chunk([], -1); // ValueError: array_chunk(): Argument #2 ($length) must be greater than 0


// 抛出异常, 更加方便使用try...catch...进行异常捕获

// PHP 8.0 专题页给出的结语:
// 现在大多数内部函数在参数验证失败时抛出 Error 级异常。

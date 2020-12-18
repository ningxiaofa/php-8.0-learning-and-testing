<?php

// for detail: https://wiki.php.net/rfc/stringable

class Test implements Stringable {
    public function __toString(): string
    {
        return "test";
    }
}

$test = new Test;
var_dump($test . '666');
var_dump($test::class); // 新增特性：通过对象直接获取类名

// 作用: 将对象直接作为字符串使用

// Out:
// string(7) "test666"
// string(4) "Test" 

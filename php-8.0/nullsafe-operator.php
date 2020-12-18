<?php

/**
 * Nullsafe 运算符
 */

 // 又臭又长的链式调用, 每次调用之前都要先判断是否为null, 否则会报语法错误.
function php7($session) {
    $country =  null;
    if ($session !== null) {
        $user = $session->user;
        if ($user !== null) {
            $address = $user->getAddress();
        
            if ($address !== null) {
            $country = $address->country;
            }
        }
    }
}

function php8($session) {
    $country = $session?->user?->getAddress()?->country;
}

// 只针null有效
$session = null;
php7($session);
php8($session);

echo '下面是报错: ', PHP_EOL;
// 如果是未定义属性, 会报警告， 比较期待实现 ??->用法
$session = new \stdClass;
php7($session);
php8($session);


// Out:
// 下面是报错:

// Warning: Undefined property: stdClass::$user in /mnt/d/php-8.0/nullsafe-operator.php on line 11

// Warning: Undefined property: stdClass::$user in /mnt/d/php-8.0/nullsafe-operator.php on line 23

// PHP 8.0 专题页给出的结语:
// 现在可以用新的 nullsafe 运算符链式调用，而不需要条件检查 null。 如果链条中的一个元素失败了，整个链条会中止并认定为 Null。

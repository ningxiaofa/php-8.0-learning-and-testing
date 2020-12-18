<?php

/**
 * 联合类型
 */

class Number {
    private int|float $number;

    public function setNumber(int|float $number): void {
        $this->number = $number;
    }

    public function getNumber(): int|float {
        return $this->number;
    }
}

$n1 = new Number();
$n1->setNumber(20201217);
var_dump($n1->getNumber());

$n1->setNumber(2020.1217);
var_dump($n1->getNumber());

$n1->setNumber([]); // 这句话会报错, 因为跟我们声明的类型不一致. 即强类型约束

// Out:
// int(20201217)
// float(2020.1217)

// Fatal error: Uncaught TypeError: Number::setNumber(): Argument #1 ($number) must be of type int|float, array given, called in /mnt/d/php-8.0/union-types.php on line 30 and defined in /mnt/d/php-8.0/union-types.php:10
// Stack trace:
// #0 /mnt/d/php-8.0/union-types.php(30): Number->setNumber(Array)
// #1 {main}
//   thrown in /mnt/d/php-8.0/union-types.php on line 10

// PHP 8.0 专题页给出的结语:
// 相较于以前的 PHPDoc 声明类型的组合， 现在可以用原生支持的联合类型声明取而代之，并在运行时得到校验。
<?php

/**
 * 构造器属性提升 
 */

// PHP 7
class Point {
  public float $x;
  public float $y;
  public float $z;
  public function __construct(
    float $x = 0.0,
    float $y = 0.0,
    float $z = 0.0
  ) {
    $this->x = $x;
    $this->y = $y;
    $this->z = $z;
  }
}

// PHP 8
class Point1 {
  public function __construct(
    public float $x = 0.0,
    public float $y = 0.0,
    public float $z = 0.0,
  ) {}
}

var_dump(new Point());
var_dump(new Point1());

// Out:
// object(Point)#1 (3) { 
//     ["x"]=>
//     float(0)
//     ["y"]=>
//     float(0)
//     ["z"]=>
//     float(0)
//   }
//   object(Point1)#1 (3) {
//     ["x"]=>
//     float(0)
//     ["y"]=>
//     float(0)
//     ["z"]=>
//     float(0)
//   }

// 可以看到有一把梭的快感~~

// PHP 8.0 专题页给出的结语:
// 更少的样板代码来定义并初始化属性。

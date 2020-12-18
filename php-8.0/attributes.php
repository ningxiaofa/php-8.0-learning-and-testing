<?php

// 注解
// 作用: 参考官方文档
// 作用之一: 将配置分散管理.[一般来说, 采用配置信息放在若干个文件中集中管理], 这里要留意, 集中管理与分散管理并不是孰优孰劣的关系, 而是是否适合当前场景的关系.


// // PHP 7
// class PostsController
// {
//     /**
//      * @Route("/api/posts/{id}", methods={"GET"})
//      */
//     public function get($id) { /* ... */ }
// }

// // PHP 8
// class Posts1Controller
// {
//     #[Route("/api/posts/{id}", methods: ["GET"])]
//     public function get($id) { /* ... */ }
// }

// // 可以看到写法上有些不同. PHP 8更加简洁. # 本身也是注释的方式之一.但是不能只用#,不然没法区分注释与注解.


// ==================================================自定义注解=================================================
/**
 * 属性(注解)
 */

namespace My\Attributes {
    use Attribute;

    /**
     * 加上 Attribute 就是声明 SingleArgument 为一个注解类
     */
    #[Attribute]
    class SingleArgument
    {
        public $argumentValue;

        public function __construct($argumentValue)
        {
            $this->argumentValue = $argumentValue;
        }
    }
}

namespace { // No Namespace: global code
    use My\Attributes\SingleArgument;

    /**
     * 把 SingleArgument 注解加在 Foo 上
     */
    #[SingleArgument("Hello Wolrd")]
    class Foo
    {
    }

    //通过反射获取 SingleAttribute 注解与参数
    $reflectionClass = new \ReflectionClass(Foo::class);
    $attributes = $reflectionClass->getAttributes();

    var_dump('注解类名: ' . $attributes[0]->getName());
    var_dump('注解参数: ', $attributes[0]->getArguments());
}

// Out:
// string(42) "注解类名: My\Attributes\SingleArgument"      
// string(14) "注解参数: "
// array(1) {
//   [0]=>
//   string(11) "Hello Wolrd"
// }

// Note:
// 1. 同一个文件中, 为不同类定义命名空间的写法 namespace 命名空间名称 {}
// for detail: https://www.php.net/manual/zh/language.namespaces.php
// 2. 不论什么语言, 注解原理都是通过反射来实现的.
// for detail: https://www.php.net/manual/zh/book.reflection.php, https://blog.csdn.net/william_n/article/details/89519692


// PHP 8.0 专题页给出的结语:
// 现在可以用 PHP 原生语法来使用结构化的元数据，而非 PHPDoc 声明

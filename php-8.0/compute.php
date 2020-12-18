<?php

/**
 * 即时编译
 * PHP 8 引入了两个即时编译引擎。 
 * Tracing JIT 在两个中更有潜力，它在综合基准测试中显示了三倍的性能， 并在某些长时间运行的程序中显示了 1.5-2 倍的性能改进。 
 * 典型的应用性能则和 PHP 7.4 不相上下。
 * for detail: https://www.php.net/releases/8.0/zh.php
 */

// jit 对计算密集型场景的性能提升是非常巨大的, 对CRUD的性能提升并不是很明显, 但是相信, 在经过PHP开发组不断的优化, PHP的性能将有会更高的提升. 
// [我们的业务多数为io密集型场景]

// 这里使用 冒泡算法 进行性能的比较
function bubbleSort(array &$arr){
    $length = count($arr);
    $num = $length - 1;
    for($i = 0; $i < $length; $i++){
        for($j = 0; $j < $num; $j++){
            if($arr[$j] > $arr[$j+1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
}

$array = range(1, 10000);
$time = microtime(true);
bubbleSort($array);
var_dump(microtime(true) - $time);
// var_dump($array);

// Docker:
// CPUs: 2
// Memory: 4.00 GB
// Swap: 1 GB

// 分别使用PHP镜像如下:
// 8.0-cli
// 7.4-cli
// 5.6-cli

// 运行容器测试:
// 冒泡排序: range(1, 1000);

// PHP 8 with jit:
// 执行命令: php -dopcache.enable_cli=on -dopcache.jit=1205 -dopcache.jit_buffer_size=64M compute.php
// float(0.7394640445709229)
// float(0.7135009765625)
// float(0.7007088661193848)
// avg_time: 0.7179s

// PHP 8 without jit:
// 执行命令: php compute.php
// float(2.2466330528259277)
// float(2.279315948486328)
// float(2.2002217769622803)
// avg_time: 2.2420s

// PHP 7.4
// float(2.3808090686798)
// float(2.4190850257874)
// float(2.4786019325256)
// avg_time: 2.4261s

// PHP 5.6
// float(19.611121892929)
// float(19.957134008408)
// float(19.330636024475)
// avg_time: 19.6329.s

// 调整 CPUs为 4, 其他不变, 输出结果:

// 8.0 with jit
// float(0.7168970108032227)
// float(0.7139320373535156)
// float(0.6942658424377441
// avg_time: 0.7084s

// 8.0 without jit
// float(2.1809449195861816)
// float(2.258208990097046)
// float(2.3160738945007324)
// avg_time: 2.2517s

// 7.4
// float(2.2731828689575)
// float(2.2631080150604)
// float(2.3577010631561)
// avg_time: 2.2980s

// 5.6
// float(19.071826934814)
// float(19.167896032333)
// float(19.43839597702)
// avg_time: 19.2260s


// 性能结论:
// 1. PHP 8 with jit 是 PHP 8 without jit 的3倍作用性能
// 2. PHP 5.6 >> PHP 7.4 >> PHP 8 without jit >> PHP 8 with jit, 在计算密集型场景下, 性能提升是很明显的.
// 3. 在上面的计算量内, 增加 CPUs, 对 PHP 8几乎无影响, 对其他版本有少许影响, 性能有所提升. Note: 因为前者计算过程中, cpu使用率并未到100%, 后者则超过了100%, cpus一定程度上对其有所限制.
// 4. 典型场景下, 并未测试, 性能请参考官方文档.

// Note:
// 启用 opcache 步骤
// 1. php -i|grep opcache // 检查否启用opcache
    // [可选操作] php -m // 查看 [Zend Modules] 下是否有 Zend OPcache 选项

// 2. echo "zend_extension=opcache.so" >> /usr/local/etc/php/php.ini // 将 opcache扩展 加入到php配置文件中.
    // 辅助[可选操作]： whereis php 输出：php: /usr/local/bin/php /usr/local/etc/php /usr/local/lib/php /usr/local/php

// 3. php -i|grep opcache // 确认是否启用opcache成功, 同时查看 opcache 配置信息
    // 建议[可选操作]： php -i|grep opcache >> opcache.default.configration  // 将opcache的默认配置信息输出到文件中, 可以看下.
    // [可选操作] php -m // 查看 [Zend Modules] 下是否有 Zend OPcache 选项

    // 查看输出的配置信息可知: 默认没有启用cli下的 opcache 
    // opcache.enable => On => On
    // opcache.enable_cli => Off => Off

// 4. 执行命令: php -dopcache.enable_cli=on -dopcache.jit=1205 -dopcache.jit_buffer_size=64M compute.php  // PHP 8 with jit

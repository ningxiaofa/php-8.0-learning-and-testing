<?php

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
<?php

// for detail: https://wiki.php.net/rfc/weak_maps

$wm = new WeakMap();

$o = new stdClass;

class A {
    public function __destruct()
    {
       echo "Dead!\n"; 
    }
}

$wm[$o] = new A;

// var_dump($wm);
// Out:
// object(WeakMap)#1 (1) {
//     [0]=>
//     array(2) {
//         ["key"]=>
//             object(stdClass)#2 (0) {
//         }
//         ["value"]=>
//             object(A)#3 (0) {
//         }
//     }
// }

var_dump(count($wm));

echo "Unsetting...\n";
unset($o);
echo "Done\n";
// var_dump($wm);
// object(WeakMap)#1 (0) {
// }
var_dump(count($wm));

// Out:
// int(1)
// Unsetting...
// Dead!
// Done
// int(0)
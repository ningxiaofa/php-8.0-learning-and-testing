<?php

// PHP 7: 需要切换到 php7 版本下执行
strlen([]); // Warning: strlen() expects parameter 1 to be string, array given
array_chunk([], -1); // Warning: array_chunk(): Size parameter expected to be greater than 0

// Out:

// Warning: strlen() expects parameter 1 to be string, array given in /mnt/d/error.php on line 4

// Warning: array_chunk(): Size parameter expected to be greater than 0 in /mnt/d/error.php on line 5

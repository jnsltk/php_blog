<?php
$a = [1, 2, 3];

unset($a[0]);
unset($a[1]);

if ($a) {
    echo 'not empty' . $a[1];
} else {
    echo 'empty';
}
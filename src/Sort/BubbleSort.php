<?php

namespace App\Sort;

class BubbleSort
{
    public function iterative(array &$list): void
    {
        for ($i = count($list); $i > 0; $i--) {
            for ($j = 1; $j < $i; $j++) {
                if ($list[$j-1] > $list[$j]) {
                    $temp       = $list[$j];
                    $list[$j]   = $list[$j-1];
                    $list[$j-1] = $temp;
                }
            }
        }
    }
}
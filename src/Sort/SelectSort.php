<?php

namespace App\Sort;

class SelectSort
{
    public static function iterative(array &$list): void
    {
        $i = 0;
        while ($i < count($list)) {

            $j     = $i;
            $minId = $j++;
            $min   = $list[$minId];

            while ($j < count($list)) {
                if ($min > $list[$j]) {
                    $minId = $j;
                    $min   = $list[$j];
                }
                $j++;
            }
            $list[$minId] = $list[$i];
            $list[$i++]   = $min;
        }
    }
}
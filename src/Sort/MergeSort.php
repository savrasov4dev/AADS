<?php

namespace App\Sort;

class MergeSort
{
    public static function recursive(array $list): array
    {
        if (count($list) < 2)
            return $list;

        $mid   = ceil((count($list) - 1) / 2);
        $left  = self::recursive(array_slice($list, 0, $mid));
        $right = self::recursive(array_slice($list, $mid));

        $buf = [];

        while (count($left) > 0 && count($right) > 0) {
            $buf[] = $left[0] <= $right[0]
                ? array_shift($left)
                : array_shift($right);
        }

        if (count($left) < 1) {
            array_splice($buf, count($buf), 0, $right);
        }

        if (count($right) < 1) {
            array_splice($buf, count($buf), 0, $left);
        }

        return $buf;

    }

    public static function iterative(array &$list): array
    {
        if (count($list) < 2)
            return $list;

        $mid   = ceil((count($list) - 1) / 2);
        $stack = [
            array_slice($list, $mid),
            array_slice($list, 0, $mid),
        ];

        $list = null;

        $queue = [];

        while (count($stack) > 0) {

            $leftRight = [
                array_pop($stack),
                array_pop($stack)
            ];

            foreach ($leftRight as $half) {
                if (count($half) > 1) {
                    $mid     = ceil((count($half) - 1) / 2);
                    $stack[] = array_slice($half, 0, $mid);
                    $stack[] = array_slice($half, $mid);
                } else {
                    $queue[] = $half;
                }
            }
        }

        while (count($queue) > 1) {

            [$left, $right] = [
                array_shift($queue),
                array_shift($queue)
            ];

            $buf = [];

            while (count($left) > 0 && count($right) > 0) {
                $buf[] = $left[0] < $right[0]
                    ? array_shift($left)
                    : array_shift($right);
            }

            if (count($left) < 1) {
                array_splice($buf, count($buf), 0, $right);
            }

            if (count($right) < 1) {
                array_splice($buf, count($buf), 0, $left);
            }

            $queue[] = $buf;
        }

        return array_shift($queue);
    }
}
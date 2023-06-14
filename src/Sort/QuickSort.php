<?php

namespace App\Sort;

class QuickSort
{
    public static function simplistic(array &$list): array
    {
        if (count($list) < 2)
            return $list;

        $pivotId = (int) ceil(count($list) / 2);
        $left  = $right = [];
        $pivot = $list[$pivotId];

        foreach ($list as $id => $item) {
            if ($pivotId === $id) continue;
            if ($item > $pivot) {
                $right[] = $item;
            } else {
                $left[]  = $item;
            }
        }

        $list = null;

        return array_merge(
            self::simplistic($left),
            [$pivot],
            self::simplistic($right)
        );
    }

    public static function recursive(array &$list, ?int $left = null, ?int $right = null): void
    {
        // First initial
        if ($left === null) {
            $left  = 0;
            $right = count($list) - 1;
        }

        // Base case
        if ($left >= $right)
            return;

        // Recursive case
        $pivot = $list[floor(($left + $right) / 2)];

        for (
            $newLeft  = $left,
            $newRight = $right;
            $newLeft <= $newRight;
        ) {
            while ($list[$newLeft] < $pivot) $newLeft++;
            while ($list[$newRight] > $pivot) $newRight--;

            if ($newLeft <= $newRight) {
                $temp = $list[$newLeft];
                $list[$newLeft++]  = $list[$newRight];
                $list[$newRight--] = $temp;
            }
        }

        self::recursive($list, $left, $newRight);
        self::recursive($list, $newLeft, $right);
    }

    public static function iterative(&$list): void
    {
        $left  = 0;
        $right = count($list) - 1;

        $unsortedSectionsStack = [[$left, $right]];

        while (count($unsortedSectionsStack) > 0) {
            [$left, $right] = array_pop($unsortedSectionsStack);
            $newLeft  = $left;
            $newRight = $right;
            $pivot    = $list[floor(($newLeft + $newRight) / 2)];

            while ($newLeft <= $newRight) {
                while ($list[$newLeft] < $pivot) $newLeft++;
                while ($list[$newRight] > $pivot) $newRight--;
                if ($newLeft <= $newRight) {
                    $temp = $list[$newLeft];
                    $list[$newLeft++]  = $list[$newRight];
                    $list[$newRight--] = $temp;
                }
            }

            if ($left < $newRight)
                $unsortedSectionsStack[] = [$left, $newRight];
            if ($newLeft < $right)
                $unsortedSectionsStack[] = [$newLeft, $right];
        }
    }
}
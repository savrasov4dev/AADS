<?php

namespace App\Search;

class BinarySearch
{
    public function iterative(int $target, array $sortList): ?int
    {
        $start = 0;
        $end = count($sortList) - 1;

        while ($start <= $end) {
            $mid = floor(($start + $end) / 2);
            if ($sortList[$mid] === $target)
                return $mid;
            if ($sortList[$mid] < $target)
                $start = $mid + 1;
            else
                $end = $mid - 1;
        }

        return null;
    }

    public function recursive(int $target, array $sortList, ?int $start = null, ?int $end = null): ?int
    {
        if ($start === null) {
            $start = 0;
            $end = count($sortList) - 1;
        }
        // Base cases
        if ($start > $end) return null;

        $mid = floor(($start + $end) / 2);

        if ($sortList[$mid] == $target) return $mid;

        // Recursive cases
        if ($sortList[$mid] < $target)
            return $this->recursive($target, $sortList, $mid + 1, $end);

        return $this->recursive($target, $sortList, $start, $mid - 1);
    }

    public function recursiveClosure(int $target, array $sortList): ?int
    {
        $start = 0;
        $end = count($sortList) - 1;

        $closure = function ($start, $end) use (&$closure, $sortList, $target) {
            // Base cases
            if ($start > $end) return null;

            $mid = floor(($start + $end) / 2);

            if ($sortList[$mid] == $target) return $mid;

            // Recursive cases
            if ($sortList[$mid] < $target)
                return $closure($mid + 1, $end);

            return $closure($start, $mid - 1);
        };

        return $closure($start, $end);
    }
}
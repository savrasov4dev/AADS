<?php

namespace Tests\Sort;

use App\Sort\SelectSort;
use PHPUnit\Framework\TestCase;

class SelectSortTest extends TestCase
{

    public function testIterative()
    {
        $firstList = range(0, 3000, 3);
        shuffle($firstList);

        $secondList = $firstList;

        sort($firstList);
        SelectSort::iterative($secondList);

        $this->assertEquals($firstList, $secondList);
    }
}

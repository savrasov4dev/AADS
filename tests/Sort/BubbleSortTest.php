<?php

namespace Tests\Sort;

use App\Sort\BubbleSort;
use PHPUnit\Framework\TestCase;

class BubbleSortTest extends TestCase
{

    public function testIterative()
    {
        $firstList = range(0, 3000, 3);
        shuffle($firstList);

        $secondList = $firstList;

        sort($firstList);
        (new BubbleSort())->iterative($secondList);

        $this->assertEquals($firstList, $secondList);
    }
}

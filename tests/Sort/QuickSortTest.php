<?php

namespace Tests\Sort;

use App\Sort\QuickSort;
use PHPUnit\Framework\TestCase;

class QuickSortTest extends TestCase
{
    private array $sortedList;
    private ?array $unsortedList;
    protected function setUp(): void
    {
        $this->unsortedList = range(0, 3000, 3);
        $this->sortedList = $this->unsortedList;
        shuffle($this->unsortedList);
        sort($this->sortedList);
    }

    public function testSimplistic()
    {
        $this->assertEquals($this->sortedList, QuickSort::simplistic($this->unsortedList));
    }

    public function testRecursive()
    {
        QuickSort::recursive($this->unsortedList);
        $this->assertEquals($this->sortedList, $this->unsortedList);
    }

    public function testIterative()
    {
        QuickSort::iterative($this->unsortedList);
        $this->assertEquals($this->sortedList, $this->unsortedList);
    }
}

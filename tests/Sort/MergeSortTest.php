<?php

namespace Tests\Sort;

use App\Sort\MergeSort;
use PHPUnit\Framework\TestCase;

class MergeSortTest extends TestCase
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

    public function testIterative()
    {
        $this->assertEquals($this->sortedList, MergeSort::iterative($this->unsortedList));
    }

    public function testRecursive()
    {
        $this->assertEquals($this->sortedList, MergeSort::recursive($this->unsortedList));
    }
}

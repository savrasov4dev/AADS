<?php

namespace Tests\Search;

use App\Search\BinarySearch;
use PHPUnit\Framework\TestCase;

class BinarySearchTest extends TestCase
{
    private BinarySearch $bs;
    private array $sortList;
    private int $count;

    protected function setUp(): void
    {
        $this->bs = new BinarySearch();
        $this->count = 10000;
        $this->sortList = $this->creatSortList();
    }

    public function testIterative()
    {
        $this->checkAllElements([$this->bs, 'iterative']);
    }

    public function testRecursive()
    {
        $this->checkAllElements([$this->bs, 'recursive']);
    }

    public function testRecursiveClosure()
    {
        $this->checkAllElements([$this->bs, 'recursiveClosure']);
    }

    private function creatSortList(): array
    {
        $list = [];

        for ($i = 0; $i < $this->count; $i++) {
            $list[] = rand(-$this->count, $this->count);
        }

        sort($list);

        return $list;
    }

    private function checkAllElements(callable $binarySearchMethod): void
    {
        for ($i = 0; $i < $this->count; $i++) {
            $needle = $this->sortList[$i];
            $result = $binarySearchMethod($needle, $this->sortList);
            $allMatchesKeys = array_keys($this->sortList, $needle);

            $message = "\nresult: $result
            \nneedle: $needle
            \nindex: $i
            \nMatchesKeys: ". json_encode($allMatchesKeys) . "
            \n";

            $this->assertContains($result, $allMatchesKeys, $message);
        }
    }
}

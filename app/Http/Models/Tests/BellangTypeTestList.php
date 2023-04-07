<?php

namespace App\Http\Models\Tests;

class BellangTypeTestList extends TypeTestList
{
    protected $prefix = 'bellang';

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }
}

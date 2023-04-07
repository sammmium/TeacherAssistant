<?php

namespace App\Http\Models\Tests;

class RuslangTypeTestList extends TypeTestList
{
    protected $prefix = 'ruslang';

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }
}

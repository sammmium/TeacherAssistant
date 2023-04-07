<?php

namespace App\Http\Models\Tests;

class BellitTypeTestList extends TypeTestList
{
    protected $prefix = 'bellit';

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }
}

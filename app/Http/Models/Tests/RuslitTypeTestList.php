<?php

namespace App\Http\Models\Tests;

class RuslitTypeTestList extends TypeTestList
{
    protected $prefix = 'ruslit';

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }
}

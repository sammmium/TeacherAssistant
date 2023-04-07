<?php

namespace App\Http\Models\Tests;

class MathTypeTestList extends TypeTestList
{
	protected $prefix = 'math';

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }
}

<?php

namespace App\Http\Models\Tests;

interface TestTypeInterface
{
    public function getTypeList(): array;

    public function getTypeName(): string;
}

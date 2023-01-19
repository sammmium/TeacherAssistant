<?php

namespace App\Http\Interfaces;

interface CoreInterface
{
    public function getDataItem(): array;

    public function getDataList(): array;
}

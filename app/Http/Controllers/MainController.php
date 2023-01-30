<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function fillParams(array $data, string $key, array $result = []): array
    {
        if (!empty($data[$key])) $result[$key] = $data[$key];

        return $result;
    }
}

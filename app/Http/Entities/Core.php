<?php

namespace App\Http\Entities;

class Core
{
    private $core;

    public function set($key, $value): void
    {
        $this->core[$key] = $value;
    }

    public function get($key, $subKey = null)
    {
        return is_null($subKey)
            ? (!empty($this->core[$key]) ?: null)
            : (!empty($this->core[$key][$subKey]) ?: null);
    }

    public function getCore(): array
    {
        return $this->core;
    }
}

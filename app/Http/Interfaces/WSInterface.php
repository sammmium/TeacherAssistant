<?php

namespace App\Http\Interfaces;

interface WSInterface
{
    public function init(): void;

    public function selectRoute(): string;

    public function has(string $name): bool;

    public function get(string $name);

    public function clean(string $name): void;

    public function cleanAll(): void;

    public function add(string $name, string $value): void;

    public function set(string $name, string $value): void;

    public function edit(string $name, string $value): void;
}

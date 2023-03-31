<?php

namespace App\Http\Models\Tests;

class BellangTypeTestList implements TestTypeInterface
{
    private $typeList = [

        // 1 класс
        1 => [
            'bellang_kkr' => 'Камбiнаваная кантрольная работа',
            'bellang_ks' => 'Кантрольнае спiсванне',
            'bellang_ksd' => 'Кантрольны слоунiкавы дыктант',
        ],

        // 2 класс
        2 => [
            'bellang_kkr' => 'Камбiнаваная кантрольная работа',
            'bellang_ks' => 'Кантрольнае спiсванне',
            'bellang_ksd' => 'Кантрольны слоунiкавы дыктант',
        ],

        // 3 класс
        3 => [
            'bellang_kkr' => 'Камбiнаваная кантрольная работа',
            'bellang_ks' => 'Кантрольнае спiсванне',
            'bellang_ksd' => 'Кантрольны слоунiкавы дыктант',
        ],

        // 4 класс
        4 => [
            'bellang_kkr' => 'Камбiнаваная кантрольная работа',
            'bellang_ks' => 'Кантрольнае спiсванне',
            'bellang_ksd' => 'Кантрольны слоунiкавы дыктант',
        ],

    ];

    private $group;

    private $key;

    public function __construct(int $group, string $key = null)
    {
        $this->group = $group;
        $this->key = $key;
    }

    public function getTypeList(): array
    {
        return $this->typeList[$this->group];
    }

    public function getTypeName(): string
    {
        if (is_null($this->key)) {
            return '';
        }

        return $this->typeList[$this->group][$this->key];
    }
}

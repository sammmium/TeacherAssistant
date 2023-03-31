<?php

namespace App\Http\Models\Tests;

class RuslangTypeTestList implements TestTypeInterface
{
    private $typeList = [

        // 1 класс
        1 => [
            'ruslang_ksd' => 'Контрольный словарный диктант',
            'ruslang_kd' => 'Контрольный диктант',
            'ruslang_kdg' => 'Контрольный диктант с грамматическим заданием',
            'ruslang_kkr' => 'Комбинированная контрольная работа',
            'ruslang_kr' => 'Контрольная работа',
            'ruslang_ks' => 'Контрольное списывание',
        ],

        // 2 класс
        2 => [
            'ruslang_ksd' => 'Контрольный словарный диктант',
            'ruslang_kd' => 'Контрольный диктант',
            'ruslang_kdg' => 'Контрольный диктант с грамматическим заданием',
            'ruslang_kkr' => 'Комбинированная контрольная работа',
            'ruslang_kr' => 'Контрольная работа',
            'ruslang_ks' => 'Контрольное списывание',
        ],

        // 3 класс
        3 => [
            'ruslang_ksd' => 'Контрольный словарный диктант',
            'ruslang_kd' => 'Контрольный диктант',
            'ruslang_kdg' => 'Контрольный диктант с грамматическим заданием',
            'ruslang_kkr' => 'Комбинированная контрольная работа',
            'ruslang_kr' => 'Контрольная работа',
            'ruslang_ks' => 'Контрольное списывание',
        ],

        // 4 класс
        4 => [
            'ruslang_ksd' => 'Контрольный словарный диктант',
            'ruslang_kd' => 'Контрольный диктант',
            'ruslang_kdg' => 'Контрольный диктант с грамматическим заданием',
            'ruslang_kkr' => 'Комбинированная контрольная работа',
            'ruslang_kr' => 'Контрольная работа',
            'ruslang_ks' => 'Контрольное списывание',
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

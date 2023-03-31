<?php

namespace App\Http\Models\Tests;

class RuslitTypeTestList implements TestTypeInterface
{
    private $typeList = [

        // 1 класс
        1 => [
            'ruslit_nch' => 'Навыки чтения',
            'ruslit_half' => 'Навыки чтения за полугодие',
        ],

        // 2 класс
        2 => [
            'ruslit_nch' => 'Навыки чтения',
            'ruslit_half' => 'Навыки чтения за полугодие',
        ],

        // 3 класс
        3 => [
            'ruslit_nch' => 'Навыки чтения',
            'ruslit_half' => 'Навыки чтения за полугодие',
        ],

        // 4 класс
        4 => [
            'ruslit_nch' => 'Навыки чтения',
            'ruslit_half' => 'Навыки чтения за полугодие',
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

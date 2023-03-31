<?php

namespace App\Http\Models\Tests;

class BellitTypeTestList implements TestTypeInterface
{
    private $typeList = [

        // 1 класс
        1 => [
            'bellit_nch' => 'Навыки чытання',
            'bellit_half' => 'Навыки чытання за паугоддзе',
        ],

        // 2 класс
        2 => [
            'bellit_nch' => 'Навыки чытання',
            'bellit_half' => 'Навыки чытання за паугоддзе',
        ],

        // 3 класс
        3 => [
            'bellit_nch' => 'Навыки чытання',
            'bellit_half' => 'Навыки чытання за паугоддзе',
        ],

        // 4 класс
        4 => [
            'bellit_nch' => 'Навыки чытання',
            'bellit_half' => 'Навыки чытання за паугоддзе',
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

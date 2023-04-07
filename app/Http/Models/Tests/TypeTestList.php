<?php

namespace App\Http\Models\Tests;

use App\Http\Traits\FormSlots;
use App\Http\Traits\Helper;

class TypeTestList implements TestTypeInterface
{
    protected $typeList = [
        // Математика
        'mkr' => 'Контрольная работа',
        'mkus' => 'Контрольный устный счет',

        // Белорусский язык
        'bkkr' => 'Камбiнаваная кантрольная работа',
        'bks' => 'Кантрольнае спiсванне',
        'bksd' => 'Кантрольны слоунiкавы дыктант',

        // Белорусская литература
        'bnch' => 'Навыкi чытання',
        'bhalf' => 'Навыкi чытання за паугоддзе',

        // Русский язык
        'rksd' => 'Контрольный словарный диктант',
        'rkd' => 'Контрольный диктант',
        'rkdg' => 'Контрольный диктант с грамматическим заданием',
        'rkkr' => 'Комбинированная контрольная работа',
        'rkr' => 'Контрольная работа',
        'rks' => 'Контрольное списывание',

        // Русская литература
        'rnch' => 'Навыки чтения',
        'rhalf' => 'Навыки чтения за полугодие',
    ];

    protected $group;

    protected $key;

    use FormSlots;
    use Helper;

    public function getTypeList(): array
    {
        $result = [];

        foreach ($this->slots[$this->prefix][$this->group] as $type => $slot) {
            $result[self::gatherTestType($this->prefix, $type)] = $this->typeList[$type];
        }

        return $result;
    }

    public function getTypeName(): string
    {
        if (is_null($this->key)) {
            return '';
        }

        $data = self::transformTestType($this->key);

        return $this->typeList[$data['type']];
    }

}

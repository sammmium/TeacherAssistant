<?php

namespace App\Http\Models\Tests;

class TestFactory implements TestTypeInterface
{
    private $type;

    private $subject;

    private $group;

    private $key;

    public function __construct(string $subject, int $group, string $key = null)
    {
        $this->subject = $subject;
        $this->group = $group;
        $this->key = $key;

        switch ($this->subject) {
            case 'math':
                $this->type = new MathTypeTestList($this->group, $this->key);
                break;
            case 'bellang':
                $this->type = new BellangTypeTestList($this->group, $this->key);
                break;
            case 'bellit':
                $this->type = new BellitTypeTestList($this->group, $this->key);
                break;
            case 'ruslang':
                $this->type = new RuslangTypeTestList($this->group, $this->key);
                break;
            case 'ruslit':
                $this->type = new RuslitTypeTestList($this->group, $this->key);
                break;
            default:
                throw new \Exception('Для выбранного предмета не найден модуль анализа и подготовки результата контрольных работ.');
        }
    }

    public function getTypeList(): array
    {
        return $this->type->getTypeList();
    }

    public function getTypeName(): string
    {
        return $this->type->getTypeName();
    }
}

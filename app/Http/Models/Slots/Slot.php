<?php

namespace App\Http\Models\Slots;

class Slot
{
    private $prefix;

    private $group;

    private $type;

    private $name;

    private $value;

    public $is_main = false;

    public $is_woe = true;

    public $is_we = false;

    public $is_wr = false;

    public $inputType;

    public $inputName;

    public $inputPlaceholder;

    public $inputValue;

    public function __construct(array $options)
    {
        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }

        $this->analyzeSlot();
    }

    public function get(): Slot
    {
        return $this;
    }

    private function analyzeSlot()
    {
        $this->isMain();
        $this->isWOE();
        $this->isWE();
        $this->isWR();

        $this->fillInputName();
        $this->fillInputPlaceholder();
        $this->fillInputType();
        $this->fillInputValue();
    }

    private function isMain(): void
    {
        $this->is_main = !strpos($this->name, '_');
    }

    private function isWOE(): void
    {
        $this->is_woe = (!$this->is_main && strpos($this->name, '_woe'));
    }

    private function isWE(): void
    {
        $this->is_we = (!$this->is_main && strpos($this->name, '_we'));
    }

    private function isWR(): void
    {
        $this->is_wr = (!$this->is_main && strpos($this->name, '_wr'));
    }

    private function fillInputType()
    {
        $this->inputType = $this->value['type'];
    }

    private function fillInputPlaceholder()
    {
        $this->inputPlaceholder = $this->value['placeholder'];
    }

    private function fillInputValue()
    {
        $this->inputValue = $this->value['placeholder'];
    }

    private function fillInputName()
    {
        $this->inputName = $this->name;
    }
}

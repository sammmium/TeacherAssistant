<?php

namespace App\Http\Models\Forms;

use App\Http\Models\Slots\SlotsFactory;
use Illuminate\Support\Facades\Validator;

class FormManager implements FormManagerInterface
{
    private $sub;

    private $group;

    private $type;

    private $slots;

    public function __construct(array $options)
    {
        $rules = [
            'sub' => 'required|string',
            'group' => 'required|numeric',
            'type' => 'required|string',
        ];
        Validator::make($options, $rules)->validate();

        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }

        $slotFactory = new SlotsFactory($options);
        $this->slots = $slotFactory->getSlots();
    }

    public function getFormItems(): array
    {
        if ($this->hasForm()) {
            return $this->showForm();
        }

        return $this->createForm();
    }

    private function hasForm(): bool
    {
        // TODO сделать обращение к БД
        return false;
    }

    private function selectSlotsData(array $result): array
    {
        $i = 1;
        foreach ($this->slots as $slot) {
            $result['slots'][] = [
                'type' => $slot->inputType,
                'name' => $slot->inputName,
                'placeholder' => $slot->inputPlaceholder,
                'value' => $slot->inputValue,
                'is_main' => $slot->is_main,
                'is_woe' => $slot->is_woe,
                'is_we' => $slot->is_we,
                'is_wr' => $slot->is_wr,
                'tabindex' => $i,
            ];
            $i++;
        }

        return $result;
    }

    private function showForm(): array
    {
        $result = [
            'view' => 'show',
        ];

        return $this->selectSlotsData($result);
    }

    private function createForm(): array
    {
        $result = [
            'view' => 'create',
        ];

        return $this->selectSlotsData($result);
    }
}

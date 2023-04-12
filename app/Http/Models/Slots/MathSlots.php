<?php

namespace App\Http\Models\Slots;

use App\Http\Traits\FormSlots;
use App\Http\Traits\Helper;

class MathSlots implements SlotInterface
{
    private $prefix = 'math';

    private $group;

    private $type;

    private $name;

    use FormSlots;
    use Helper;

    public function __construct(array $options)
    {
        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getSlots(): array
    {
        $result = [];
        foreach ($this->slots[$this->prefix][$this->group][$this->type] as $name => $item) {
            $slot = new Slot([
                'prefix' => $this->prefix,
                'group' => $this->group,
                'type' => $this->type,
                'name' => $name,
                'value' => $item,
            ]);
            $result[] = $slot->get();
        }

        return $result;
    }

    public function getSlot(): Slot
    {
        $item = $this->slots[$this->prefix][$this->group][$this->type][$this->name];

        $slot = new Slot([
            'prefix' => $this->prefix,
            'group' => $this->group,
            'type' => $this->type,
            'name' => $this->name,
            'value' => $item,
        ]);

        return $slot->get();
    }
}

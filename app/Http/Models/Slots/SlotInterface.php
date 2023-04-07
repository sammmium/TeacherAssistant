<?php

namespace App\Http\Models\Slots;

interface SlotInterface
{
    public function getSlots(): array;

    public function getSlot(): Slot;
}

<?php

namespace App\Http\Models\Slots;

interface SlotsFactoryInterface
{
    public function getSlots(): array;

    public function getSlot(): Slot;
}

<?php

namespace App\Http\Models\Slots;

use Exception;
use Illuminate\Support\Facades\Log;

class SlotsFactory implements SlotsFactoryInterface
{
    private $concreteSlots;

    /**
     * options = [
     *   sub: math|ruslang|bellit...
     *   и другие
     * ]
     *
     * @param array $options
     * @throws \Exception
     */
    public function __construct(array $options)
    {
        try {
            $sub = $options['sub'];
            unset($options['sub']);

            switch ($sub) {
                case 'math':
                    $this->concreteSlots = new MathSlots($options);
                    break;

                default:
                    throw new \Exception('Контрольные работы для выбранного предмета пока не доступны');
            }
        } catch(Exception $ex) {
            Log::error('[' . __CLASS__ . '] ' . $ex->getMessage());
        }
    }

	public function getSlots(): array
	{
        return $this->concreteSlots->getSlots();
	}

	public function getSlot(): Slot
	{
		return $this->concreteSlots->getSlot();
	}
}

<?php

namespace App\Http\Models\Slots;

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
        $sub = $options['sub'];
        unset($options['sub']);

        switch ($sub) {
            case 'math':
                $this->concreteSlots = new MathSlots($options);
                break;

            default:
                throw new \Exception('Контрольные работы для выбранного предмета пока не доступны');
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

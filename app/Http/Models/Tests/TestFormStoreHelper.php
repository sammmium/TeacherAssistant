<?php

namespace App\Http\Models\Tests;

class TestFormStoreHelper
{
    private $input;
    private $sub;
    private $group;
    private $type;
    private $elements = [];
    private $tabindexes = [];

    public function __construct(array $input)
    {
        unset($input['_token']);
        $this->sub = $input['sub'];
        unset($input['sub']);
        $this->group = $input['group'];
        unset($input['group']);
        $this->type = $input['type'];
        unset($input['type']);
        $this->input = $input;
    }

    /**
     * выбираем только отмеченные галочкой элементы
     *
     * @return array
     */
    public function handler(): array
    {
        foreach ($this->input as $name => $value) {

            if (strpos($name, 'tabindex_') !== false) {
                $newName = str_replace('tabindex_', '', $name);
                if (!array_key_exists($newName, $this->tabindexes)) {
                    $this->tabindexes[$newName] = $value;
                }
                unset($this->input[$name]);
            }

            if (strpos($name, 'name_') !== false) {
                $newName = str_replace('name_', '', $name);
                if (!array_key_exists($newName, $this->elements)) {
                    $this->elements[$newName] = $value;
                }
                unset($this->input[$name]);
            }
        }

        $result = [];
        foreach ($this->tabindexes as $name => $value) {
            $result[$name] = [
                'tabindex' => $this->tabindexes[$name],
                'value' => $this->elements[$name],
            ];
        }

        $result['sub'] = $this->sub;
        $result['group'] = $this->group;
        $result['type'] = $this->type;

        $this->clear();

        return $result;
    }

    private function clear(): void
    {
        $list = [
            'input',
            'sub',
            'group',
            'type',
            'selected',
            'elements',
            'tabindexes'
        ];
        foreach ($list as $item) {
            unset($this->{$item});
        }
    }
}

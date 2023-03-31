<?php

namespace App\Http\Models;

use App\Http\Interfaces\WSInterface;
use App\Http\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WSDB extends WS implements WSInterface
{
    use Helper;

    public function __construct()
    {
        $this->userId = Auth::user()->id;

        $this->init();
    }

    /**
     * Инициация пустого массива с единственным заполненным значением user_id.
     *
     * @return void
     */
    public function init(): void
    {
        $rowData = $this->getRowData();

        // если такой записи в таблице нет - создаем ее
        if (empty($rowData)) {
            $input = [];
            foreach ($this->default as $item) {
                $input[$item] = ($item == 'user_id') ? $this->userId : null;
            }
            DB::table('work_status')->insert($input);

            $this->init();
        }

        foreach ($rowData as $key => $value) {
            $this->{$key} = $value;
        }
    }

    private function getRowData(): array
    {
        $sql = 'select * from work_status where user_id = :userId';
        $params = ['userId' => $this->userId];
        return self::prepare(self::getRawData($sql, $params));
    }

    /**
     * Получение маршрута.
     *
     * @return string
     */
    public function selectRoute(): string
    {
        $row = $this->all();
        $result = '/home/groups';

        foreach ($this->order as $item) {
            if ($this->has($item)) {
                $result = $this->getRoute($row, $item);
                break;
            }
        }

        return $result;
    }

    protected function getRoute(array $row, string $item): string
    {
        $target = str_replace('_id', '', $item);
        return '/home/'.$target.'/'.$row[$item];
    }

    /**
     * Проверка наличия значения у элемента массива.
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return !empty($this->{$name});
    }

    /**
     * Создание (добавление) значения элементу массива.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function add(string $name, string $value): void
    {
        $this->edit($name, $value);
    }

    /**
     * Редактирование элемента массива новым значением.
     * Так как все id есть цифры, то приводим их к int.
     * При этом прежде всего проверяем на null.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function edit(string $name, string $value = null): void
    {
        $this->{$name} = (!is_null($value)) ? (int)$value : $value;
    }

    public function set(string $name, string $value = null): void
    {
        $this->edit($name, $value);
    }

    /**
     * Получение хначения по наименованию элемента массива.
     *
     * @param string $name
     * @return mixed|string
     */
    public function get(string $name)
    {
        return $this->{$name};
    }

    /**
     * Получение всех элементов массива.
     *
     * @return array
     */
    public function all(): array
    {
        $result = [];

        foreach ($this->default as $key) {
            $result[$key] = $this->get($key);
        }

        return $result;
    }

    /**
     * Чистка (удаление) значения элемента массива.
     *
     * @param string $name
     * @return void
     */
    public function clean(string $name): void
    {
        $this->edit($name);
    }

    public function cleanBunch(array $bunch): void
    {
        foreach ($bunch as $key) {
            $this->clean($key);
        }
    }

    public function cleanAll(): void
    {
        foreach ($this->default as $key) {
            if ($key !== 'user_id') {
                $this->clean($key);
            }
        }
    }

    public function save(): void
    {
        $input = $this->all();

        DB::table('work_status')
            ->where('user_id', '=', $this->userId)
            ->update($input);
    }
}

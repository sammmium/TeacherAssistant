<?php

namespace App\Http\Models;

use App\Http\Interfaces\WSInterface;

abstract class WS implements WSInterface
{
    protected $default = [
        'user_id',
        'educational_institution_id',
        'teacher_id',
        'unit_id',
        'group_id',
        'unit_group_id',
        'subject_id',
        'unit_subject_id',
        'pupil_id',
        'unit_group_pupil_id',
        'test_id',
        'test_type_id',
        'card_id',
    ];

    protected $order = [
        'card_id',
        'test_id',
        'subject_id',
        'group_id',
    ];

    protected $userId;

    /**
     * Инициация пустого массива с единственным заполненным значением user_id.
     *
     * @return void
     */
    public function init(): void
    {

    }

    /**
     * Получение маршрута.
     *
     * @return string
     */
    public function selectRoute(): string
    {
        return '/home/groups';
    }

    /**
     * Построение маршрута.
     *
     * @param array $row
     * @param string $item
     * @return string
     */
    protected function getRoute(array $row, string $item): string
    {
        return '/home/groups';
    }

    /**
     * Возвращает строку в ином виде (если необходимо).
     * Для хранения данных в виже массива.
     *
     * @param string $name
     * @return string
     */
    protected function prepareName(string $name): string
    {
        return $name;
    }

    /**
     * Проверка наличия значения у элемента массива.
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return false;
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

    }

    /**
     * Получение хначения по наименованию элемента массива.
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return null;
    }

    /**
     * Получение всех элементов массива.
     *
     * @return array
     */
    public function all(): array
    {
        return [];
    }

    /**
     * Редактирование элемента массива новым значением.
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function edit(string $name, string $value): void
    {

    }

    public function set(string $name, string $value): void
    {

    }

    /**
     * Чистка (удаление) значения элемента массива.
     *
     * @param string $name
     * @return void
     */
    public function clean(string $name): void
    {

    }

    public function cleanAll(): void
    {

    }
}

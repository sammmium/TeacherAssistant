<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkStatus extends BaseModel
{
    protected $table = 'work_status';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
        'subject_id',
        'test_id',
        'card_id'
    ];

    /**
     * @return void
     */
    public static function init(): void
    {
        $userId = Auth::user()->id;
        if (!self::has()) {
            self::add($userId);
        }
    }

    /**
     * @return bool
     */
    public static function has(): bool
    {
        $userId = Auth::user()->id;
        $sql = 'select * from work_status where user_id = :userId';
        $params = ['userId' => $userId];
        $rawData = DB::select($sql, $params);
        return !empty($rawData);
    }

    /**
     * Получение маршрута
     *
     * Например:
     * пользователь находится на странице /home/tests/16
     * (в БД в столбце test_id записан идентификатор контрольной работы,
     * в столбце subject_id записан идентификатор предмета)
     * нажал на кнопку перехода на уровень выше - для просмотра списка
     * контрольных работ - отдельно будет вызван метод очистки
     * идентификатора контрольной работы - для редиректа отдадим пользователю
     * маршрут /home/subject/44 (так как у нас все еще выбран предмет)
     *
     * @return string
     */
    public static function selectRoute(): string
    {
        $userId = Auth::user()->id;
        $row = self::get($userId);
        $result = '/home/group/list';
        if (self::hasCardId($row)) {
            $result = self::getRoute($row, 'card');
        } else {
            if (self::hasTestId($row)) {
                $result = self::getRoute($row, 'test');
            } else {
                if (self::hasSubjectId($row)) {
                    $result = self::getRoute($row, 'subject');
                } else {
                    if (self::hasGroupId($row)) {
                        $result = self::getRoute($row, 'group');
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Построение и выдача доступного маршрута
     *
     * @param array $row
     * @param string $target
     * @return string
     */
    private static function getRoute(array $row, string $target): string
    {
        $alias = $target . '_id';
        return '/home/'.$target.'/'.$row[$alias];
    }

    /**
     * Проверка наличия идентификатора
     *
     * @param array $row
     * @return bool
     */
    private static function hasGroupId(array $row): bool
    {
        return !empty($row['group_id']);
    }

    /**
     * Проверка наличия идентификатора
     *
     * @param array $row
     * @return bool
     */
    private static function hasSubjectId(array $row): bool
    {
        return !empty($row['subject_id']);
    }

    /**
     * Проверка наличия идентификатора
     *
     * @param array $row
     * @return bool
     */
    private static function hasTestId(array $row): bool
    {
        return !empty($row['test_id']);
    }

    /**
     * Проверка наличия идентификатора
     *
     * @param array $row
     * @return bool
     */
    private static function hasCardId(array $row): bool
    {
        return !empty($row['card_id']);
    }

    /**
     * Если при попытке получения данных результат ничего не выдаст,
     * то автоматически запустится метод создания записи, после чего
     * произведется повторная попытка получения данных
     *
     * @param int $userId
     * @return array
     */
    private static function get(int $userId): array
    {
        $sql = 'select * from work_status where user_id = :userId';
        $params = ['userId' => $userId];
        $rawData = DB::select($sql, $params);
        $result = [];
        if (empty($rawData)) {
            self::add($userId);
            self::get($userId);
        }
        foreach ($rawData as $rawItem) {
            foreach ($rawItem as $key => $value) {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * @param int $userId
     * @return void
     */
    private static function add(int $userId): void
    {
        try {
            $input = [
                'user_id' => $userId
            ];

            self::create($input);
        } catch (\Exception $exception) {
            Log::error(__METHOD__ . ' неудачная попытка создания записи. (' . $exception->getMessage() . ')');
        }
    }

    /**
     * Запись в БД идентификатора для выбранной цели
     *
     * Например:
     * пользователь нажал на кнопку выбора группы на странице /home
     * (запрос уйдет по маршруту /group/select/{id})
     * перед отрисовкой страницы в текущую таблицу записывается id
     * выбранной группы - таким образом мы однозначно понимаем, что
     * следующей страницей должна быть отрисована /home/subject
     *
     * @param string $column
     * @param int $value
     * @return void
     */
    public static function set(string $column, int $value): void
    {
        $userId = Auth::user()->id;
        self::updateRow($userId, $column, $value);
    }

    /**
     * Сброс идентификатора для выбранной цели
     *
     * @param string $column
     * @return void
     */
    public static function clear(string $column): void
    {
        $userId = Auth::user()->id;
        self::updateRow($userId, $column);
    }

    /**
     * todo переделать обновление по массиву [key=>value[,...]] для обновления нескольких столбцов соответственно и методов set и clear
     *
     * @param int $userId
     * @param string $column
     * @param $value
     * @return void
     */
    private static function updateRow(int $userId, string $column, $value = null): void
    {
        try {
            $column = (strpos($column, '_id') !== false) ? $column : $column . '_id';
            self::where('user_id', $userId)
                ->update([
                    $column => $value
                ]);
        } catch (\Exception $exception) {
            Log::error(__METHOD__ . ' неудачная попытка обновления ' . $column);
        }
    }
}

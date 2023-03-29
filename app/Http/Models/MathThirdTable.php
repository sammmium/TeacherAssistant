<?php

namespace App\Http\Models;

use App\Http\Traits\Helper;

class MathThirdTable
{
    private $availableErrors = 5;

    private $member_id_list = [];

    private $unit_group_id;

    private $test_id;

    private $pupils = [];

    private $questions = [];

    private $errors = [];

    use Helper;

    /**
     * params = [
     *  unit_group_id,
     *  test_id,
     *  member_id_list
     * ]
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->member_id_list = $params['member_id_list'];
        $this->unit_group_id = $params['unit_group_id'];
        $this->test_id = $params['test_id'];

        $this->run();
    }

    private function run(): void
    {
        foreach ($this->member_id_list as $pupilId) {
            $this->pupils[$pupilId] = People::getPupil((int)$pupilId);
        }

        foreach ($this->member_id_list as $pupilId) {
            $this->questions[$pupilId] = Cards::getPupilsQuestions([
                'unit_group_id' => $this->unit_group_id,
                'pupil_id' => $pupilId,
                'test_id' => $this->test_id
            ]);
        }

        foreach ($this->member_id_list as $pupilId) {
            $this->errors[$pupilId] = [
                'count' => 0,
                'errors' => [],
                'pupil' => self::getFIO($this->pupils[$pupilId])
            ];
            foreach ($this->questions[$pupilId] as $question) {
                $this->checkErrors($pupilId, $question);
            }
        }

        foreach ($this->errors as $pupilId => $error) {
            if ($error['count'] < $this->availableErrors) {
                unset($this->errors[$pupilId]);
            } else {
                $this->errors[$pupilId]['errors'] = implode('. ', $error['errors']);
            }
        }
    }

    private function checkErrors(int $pupilId, array $question): void
    {
        $excludes = [
            'math_eq_woe',
            'math_eq_wr',

            'math_ex_woe',
            'math_ex_wr',

            'math_co_woe',
            'math_co_wr',

            'math_t_woe',
            'math_t_wr',

            'math_gt_woe',
            'math_gt_wr',

            'math_cv_woe',
            'math_cv_wr',

            'math_fx',

            'range',
        ];

        if (!in_array($question['code'], $excludes)) {
            $this->errors[$pupilId]['count']++;
            $err = str_replace('Математика. ', '', $question['description']);
            if (!in_array($err, $this->errors[$pupilId]['errors'])) {
                $this->errors[$pupilId]['errors'][] = $err;
            }
        }
    }

    public function getData(): array
    {
        return $this->errors;
    }
}

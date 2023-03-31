<?php

namespace App\Http\Models;

use App\Http\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Void_;

class MathAnalyzer extends Analyzer
{

    public function __construct(array $attributes = [])
    {
        $this->analyzer['group_id'] = (int)$attributes['group_id'];
        $this->analyzer['subject_id'] = (int)$attributes['subject_id'];
        $this->analyzer['test_id'] = (int)$attributes['test_id'];
        $this->analyzer['member_id_list'] = explode('|', $attributes['member_id_list']);
    }

    use Helper;

    public function getAnalyzedData(): array
    {
        $this->prepareMainData();
        $this->prepareCountPupils();
        $this->prepareCountMembers();
        $this->prepareRanges();
        $this->countRangeLevels();
        $this->prepareTableFirst();
        $this->prepareTableSecond();
        $this->prepareTableThird();


//        var_dump($this->analyzer);exit;
        return $this->analyzer;
    }

    protected function prepareRanges(): void
    {
        $this->analyzer['cm_10'] = Cards::countMembersWithRange($this->analyzer['test_id'], 10);
        $this->analyzer['pm_10'] = $this->getPercent($this->analyzer['cm_10']);
        $this->analyzer['cm_9'] = Cards::countMembersWithRange($this->analyzer['test_id'], 9);
        $this->analyzer['pm_9'] = $this->getPercent($this->analyzer['cm_9']);
        $this->analyzer['cm_8'] = Cards::countMembersWithRange($this->analyzer['test_id'], 8);
        $this->analyzer['pm_8'] = $this->getPercent($this->analyzer['cm_8']);
        $this->analyzer['cm_7'] = Cards::countMembersWithRange($this->analyzer['test_id'], 7);
        $this->analyzer['pm_7'] = $this->getPercent($this->analyzer['cm_7']);
        $this->analyzer['cm_6'] = Cards::countMembersWithRange($this->analyzer['test_id'], 6);
        $this->analyzer['pm_6'] = $this->getPercent($this->analyzer['cm_6']);
        $this->analyzer['cm_5'] = Cards::countMembersWithRange($this->analyzer['test_id'], 5);
        $this->analyzer['pm_5'] = $this->getPercent($this->analyzer['cm_5']);
        $this->analyzer['cm_4'] = Cards::countMembersWithRange($this->analyzer['test_id'], 4);
        $this->analyzer['pm_4'] = $this->getPercent($this->analyzer['cm_4']);
        $this->analyzer['cm_3'] = Cards::countMembersWithRange($this->analyzer['test_id'], 3);
        $this->analyzer['pm_3'] = $this->getPercent($this->analyzer['cm_3']);
        $this->analyzer['cm_2'] = Cards::countMembersWithRange($this->analyzer['test_id'], 2);
        $this->analyzer['pm_2'] = $this->getPercent($this->analyzer['cm_2']);
        $this->analyzer['cm_1'] = Cards::countMembersWithRange($this->analyzer['test_id'], 1);
        $this->analyzer['pm_1'] = $this->getPercent($this->analyzer['cm_1']);

        $this->prepareAverageRanges();
    }

    protected function prepareAverageRanges(): void
    {
        $total = 0;
        foreach ($this->analyzer as $key => $value) {
            if (strpos($key, 'cm_') !== false) {
                switch ($key) {
                    case 'cm_10': $total = $this->getAVG($total, 10, $value); break;
                    case 'cm_9': $total = $this->getAVG($total, 9, $value); break;
                    case 'cm_8': $total = $this->getAVG($total, 8, $value); break;
                    case 'cm_7': $total = $this->getAVG($total, 7, $value); break;
                    case 'cm_6': $total = $this->getAVG($total, 6, $value); break;
                    case 'cm_5': $total = $this->getAVG($total, 5, $value); break;
                    case 'cm_4': $total = $this->getAVG($total, 4, $value); break;
                    case 'cm_3': $total = $this->getAVG($total, 3, $value); break;
                    case 'cm_2': $total = $this->getAVG($total, 2, $value); break;
                    case 'cm_1': $total = $this->getAVG($total, 1, $value); break;
                }
            }
        }

        $this->analyzer['average_range'] = 0; // значение по-умолчанию

        if ($total > 0) {
            if ($this->analyzer['count_members'] > 0) {
                $this->analyzer['average_range'] = ceil($total / $this->analyzer['count_members']);
            }
        }
    }

    /**
     * Наполнение массива подсчитанными данными по карточкам
     * c инкрементом нового значения к имеющегося
     *
     * key = ключ в шаблоне
     * value = ключ к базе данных
     *
     * @return void
     */
    protected function prepareTableFirst(): void
    {
        $keys = [
            'eq_we_cm' => [
                'math_eq_eis',
                'math_eq_eic'
            ],

            'ex_we_cm' => [
                'math_ex_eio',
                'math_ex_eca',
                'math_ex_ecs',
                'math_ex_ecm',
                'math_ex_ecd'
            ],

            'co_we_cm' => [
                'math_co_n',
                'math_co_ne',
                'math_co_dcn',
                'math_co_en',
                'math_co_lv',
                'math_co_mv',
                'math_co_tv'
            ],

            't_we_cm' => [
                'math_t_dd',
                'math_t_dc'
            ],

            'gt_we_cm' => [
                'math_gt_dd',
                'math_gt_dc',
                'math_gt_ded'
            ],

            'cv_we_cm' => [
                'math_cv_l',
                'math_cv_m',
                'math_cv_t'
            ],
        ];

        foreach ($keys as $to => $fromKeys) {
            foreach ($fromKeys as $fromKey) {
                $this->incrementCount($to, Cards::countBy($this->analyzer['test_id'], $fromKey));
            }
        }

        $this->preparePercentageTable($keys);
    }

    private function incrementCount(string $to, int $value): void
    {
        if (empty($this->analyzer[$to])) {
            $this->analyzer[$to] = $value;
        } else {
            $this->analyzer[$to] += $value;
        }
    }

    private function preparePercentageTable(array $keys): void
    {
        foreach ($keys as $key => $value) {
            $to = $this->convertCmToPm($key);
            $this->analyzer[$to] = $this->getPercent($this->analyzer[$key]);
        }
    }

    private function convertCmToPm(string $key): string
    {
        return str_replace('_cm', '_pm', $key);
    }

    /**
     * Наполнение массива подсчитанными данными по карточкам.
     *
     * key = ключ в шаблоне
     * value = ключ к базе данных
     *
     * @return void
     */
    protected function prepareTableSecond(): void
    {
        $keys = [
            'eq_woe_cm' => 'math_eq_woe',
            'eq_eis_cm' => 'math_eq_eis',
            'eq_eic_cm' => 'math_eq_eic',
            'eq_wr_cm' => 'math_eq_wr',

            'ex_woe_cm' => 'math_ex_woe',
            'ex_eio_cm' => 'math_ex_eio',
            'ex_eca_cm' => 'math_ex_eca',
            'ex_ecs_cm' => 'math_ex_ecs',
            'ex_ecm_cm' => 'math_ex_ecm',
            'ex_ecd_cm' => 'math_ex_ecd',
            'ex_wr_cm' => 'math_ex_wr',

            'co_woe_cm' => 'math_co_woe',
            'co_n_cm' => 'math_co_n',
            'co_ne_cm' => 'math_co_ne',
            'co_dcn_cm' => 'math_co_dcn',
            'co_en_cm' => 'math_co_en',
            'co_lv_cm' => 'math_co_lv',
            'co_mv_cm' => 'math_co_mv',
            'co_tv_cm' => 'math_co_tv',
            'co_wr_cm' => 'math_co_wr',

            't_woe_cm' => 'math_t_woe',
            't_dd_cm' => 'math_t_dd',
            't_dc_cm' => 'math_t_dc',
            't_wr_cm' => 'math_t_wr',

            'gt_woe_cm' => 'math_gt_woe',
            'gt_dd_cm' => 'math_gt_dd',
            'gt_dc_cm' => 'math_gt_dc',
            'gt_ded_cm' => 'math_gt_ded',
            'gt_wr_cm' => 'math_gt_wr',

            'cv_woe_cm' => 'math_cv_woe',
            'cv_l_cm' => 'math_cv_l',
            'cv_m_cm' => 'math_cv_m',
            'cv_t_cm' => 'math_cv_t',
            'cv_wr_cm' => 'math_cv_wr',

            'fx_cm' => 'math_fx'
        ];

        foreach ($keys as $to => $from) {
            $this->analyzer[$to] = Cards::countBy($this->analyzer['test_id'], $from);
        }

        $this->preparePercentageTable($keys);
    }

    /*
     * xtr_tq = Вопросы темы, требующие организации поддерживающих
     * занятий с учащимися (минимум 5 ошибок в общем)
     *
     * xtr_p = Ф.И. учащегося
     */
    protected function prepareTableThird(): void
    {
        $thirdTable = new MathThirdTable([
            'member_id_list' => $this->analyzer['member_id_list'],
            'unit_group_id' => $this->analyzer['unit_group_id'],
            'test_id' => $this->analyzer['test_id']
        ]);

        $errors = $thirdTable->getData();

        foreach ($errors as $error) {
            $this->analyzer['third_table'][] = [
                'xtr_tq' => $error['errors'],
                'xtr_p' => $error['pupil'],
            ];
        }
    }
}

<?php

namespace App\Http\Models\ruslang;

use App\Http\Models\Analyzer;
use App\Http\Traits\Helper;

class RuslangAnalyzer extends Analyzer
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



        var_dump($this->analyzer);exit;
        return $this->analyzer;
    }
}

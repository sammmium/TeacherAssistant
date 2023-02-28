<?php

namespace App\Http\Models;

class Members extends BaseModel
{
    protected static $pupils;

    protected static $members;

    protected static function fillPupils()
    {

    }

    protected static function fillMembers()
    {

    }

    public static function getMembers(array $pupilList, int $testId)
    {
        $pupilsMembers = [];

        foreach ($pupilList as $pupil) {
            $member = Cards::getSelectedMember($testId, $pupil['id']);
            $pupilsMembers[] = [
                'unit_group_pupil_id' => $pupil['id'],
                'pupil' => self::getFIO($pupil),
                'member' => self::getFIO($member),
                'card_id' => !empty($member['id']) ? $member['id'] : ''
            ];
        }

        return $pupilsMembers;
    }


}

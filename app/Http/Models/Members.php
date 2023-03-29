<?php

namespace App\Http\Models;

class Members extends BaseModel
{
    protected static $pupils;

    protected static $members;

    private static function isFilled(array $member): string
    {
        $result = 'primary';

        if (!empty($member['filled'])) {
            if ($member['filled'] > 0) {
                $result = 'success';
            }
        }

        return $result;
    }

    public static function getMembers(array $pupilList, int $testId): array
    {
        $pupilsMembers = [];

        foreach ($pupilList as $pupil) {
            $member = Cards::getSelectedMember($testId, $pupil['id']);
            $pupilsMembers[] = [
                'unit_group_pupil_id' => $pupil['id'],
                'pupil' => self::getFIO($pupil),
                'member' => [
                    'id' => $pupil['id'],
                    'pupil_id' => $pupil['pupil_id'],
                    'fio' => self::getFIO($member),
                    'filled' => self::isFilled($member)
                ],
                'card_id' => !empty($member['id']) ? $member['id'] : ''
            ];
        }

        return $pupilsMembers;
    }
}

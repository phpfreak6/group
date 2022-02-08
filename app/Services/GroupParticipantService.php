<?php

namespace App\Services;

use App\Models\GroupParticipant;

class GroupParticipantService
{

    function __construct()
    {
    }

    function create($data)
    {
        $groupParticipantObj = new GroupParticipant();
        $groupParticipantObj->fill($data);
        $groupParticipantObj->save();
        return $groupParticipantObj;
    }

    function delete($dataArr)
    {
        return GroupParticipant::where([
            [
                'group_id', '=', $dataArr['group_id']
            ],
            [
                'user_id', '=', $dataArr['user_id']
            ]
        ])->delete();
    }

    function checkGroupParticipantExists($dataArr)
    {
        return GroupParticipant::where([
            ['group_id', '=', $dataArr['group_id']],
            ['user_id', '=', $dataArr['user_id']],
        ])->exists();
    }
}

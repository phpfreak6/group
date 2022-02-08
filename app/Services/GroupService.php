<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    function create($data)
    {
        $groupObj = new Group();
        $groupObj->fill($data);
        $groupObj->save();
        return $groupObj;
    }

    function checkAddRemovePermission($dataArr, $user_id)
    {
        return Group::where([
            ['group_id', '=', $dataArr['group_id']],
            ['user_id', '=', $user_id]
        ])->exists();
    }
}

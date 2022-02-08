<?php

namespace App\Services;

use App\Models\GroupMessage;

class GroupMessageService
{

    function get($group_id)
    {
        $messages = GroupMessage::where('group_id', '=', $group_id)->get();
        return $messages;
    }

    function create($data)
    {
        $groupMessageObj = new GroupMessage();
        $groupMessageObj->fill($data);
        $groupMessageObj->save();
        return $groupMessageObj;
    }

    function markMessagesAsRead($messagesObj, $user_id)
    {
        if (!empty($messagesObj)) {
            foreach ($messagesObj as $messageObj) {
                if (!in_array($user_id, $messageObj->read_status)) {
                    $messageObj->read_status = array_merge($messageObj->read_status, [$user_id]);
                    $messageObj->save();
                }
            }
        }
    }
}

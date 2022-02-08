<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

/* Request Validations */
use App\Http\Requests\GroupMessages\CreateGroupMessageRequest;

/* Services */
use App\Services\GroupMessageService;
use App\Services\GroupParticipantService;

/* Laravel Exception Class */
use Exception;

class GroupMessageController extends Controller
{

    protected $GroupMessageService;
    protected $GroupParticipantService;
    protected $auth_user_id;

    function __construct()
    {
        $this->auth_user_id = 1; // Authenticated User ID
        $this->GroupMessageService = new GroupMessageService();
        $this->GroupParticipantService = new GroupParticipantService();
    }

    /**
     * get group messages
     * @return \Illuminate\Http\JsonResponse
     */
    function get($group_id)
    {
        try {
            if (empty($this->GroupParticipantService->checkGroupParticipantExists([
                'user_id' => $this->auth_user_id,
                'group_id' => $group_id
            ]))) {
                throw new Exception('Participant does not exist in the group');
            }
            $messagesObj = $this->GroupMessageService->get($group_id);
            $this->GroupMessageService->markMessagesAsRead($messagesObj, $this->auth_user_id);
            return sendResponse('Group Messages Fetched Successfully', ['group_messages' => $messagesObj], TRUE);
        } catch (Exception $e) {
            return sendResponse($e->getMessage(), [], FALSE);
        }
    }

    /**
     * create group message
     * @return \Illuminate\Http\JsonResponse
     */
    function create(CreateGroupMessageRequest $request)
    {
        try {
            $dataArr = $request->validated();
            $dataArr['user_id'] = $this->auth_user_id;
            $dataArr['read_status'] = [$this->auth_user_id];
            if (empty($this->GroupParticipantService->checkGroupParticipantExists($dataArr))) {
                throw new Exception('Participant does not exist in the group');
            }
            $groupMessageObj = $this->GroupMessageService->create($dataArr);
            return sendResponse('Group Message Created Successfully', ['group_message' => $groupMessageObj], TRUE);
        } catch (Exception $e) {
            return sendResponse($e->getMessage(), [], FALSE);
        }
    }
}

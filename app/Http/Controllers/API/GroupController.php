<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

/* Services */
use App\Services\GroupService;
use App\Services\GroupParticipantService;

/* Request Validations */
use App\Http\Requests\Groups\CreateGroupRequest;
use App\Http\Requests\Groups\AddGroupParticipantRequest;
use App\Http\Requests\Groups\RemoveGroupParticipantRequest;

/* Laravel Exception Class */
use Exception;

class GroupController extends Controller
{

    protected $GroupService;
    protected $GroupParticipantService;
    protected $auth_user_id;

    function __construct()
    {
        $this->GroupService = new GroupService();
        $this->GroupParticipantService = new GroupParticipantService();
        $this->auth_user_id = 1; // Authenticated User ID
    }

    /**
     * create group for the authenticated user
     * @return \Illuminate\Http\JsonResponse
     */
    function create(CreateGroupRequest $request)
    {
        try {
            $dataArr = $request->validated();
            $dataArr['user_id'] = $this->auth_user_id;
            $groupObj = $this->GroupService->create($dataArr);
            $this->GroupParticipantService->create(
                ['group_id' => $groupObj->group_id, 'user_id' => $this->auth_user_id]
            );
            return sendResponse('Group Created Successfully', ['group' => $groupObj], TRUE);
        } catch (Exception $e) {
            return sendResponse($e->getMessage(), [], FALSE);
        }
    }

    /**
     * add participant in group
     * @return \Illuminate\Http\JsonResponse
     */
    function addGroupParticipant(AddGroupParticipantRequest $request)
    {
        try {
            $dataArr = $request->validated();
            if (empty($this->GroupService->checkAddRemovePermission($dataArr, $this->auth_user_id))) {
                throw new Exception('User do not have permission to add participant');
            }
            if (!empty($this->GroupParticipantService->checkGroupParticipantExists($dataArr))) {
                throw new Exception('Participant already exists in the group');
            }
            $groupParticipantObj = $this->GroupParticipantService->create($dataArr);
            return sendResponse('Group Participant Added Successfully', ['group_participant' => $groupParticipantObj], TRUE);
        } catch (Exception $e) {
            return sendResponse($e->getMessage(), [], FALSE);
        }
    }

    /**
     * remove participant from group
     * @return \Illuminate\Http\JsonResponse
     */
    function removeGroupParticipant(RemoveGroupParticipantRequest $request)
    {
        try {
            $dataArr = $request->validated();
            if (empty($this->GroupService->checkAddRemovePermission($dataArr, $this->auth_user_id))) {
                throw new Exception('User do not have permission to delete participant');
            }
            if (empty($this->GroupParticipantService->checkGroupParticipantExists($dataArr))) {
                throw new Exception('Participant does not exist in the group');
            }
            $this->GroupParticipantService->delete($dataArr);
            return sendResponse('Group Participant Removed Successfully', [], TRUE);
        } catch (Exception $e) {
            return sendResponse($e->getMessage(), [], FALSE);
        }
    }
}

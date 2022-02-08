<?php

namespace App\Http\Requests\Groups;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RemoveGroupParticipantRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'group_id' => 'required',
            'user_id' => 'required'
        ];
    }

    function failedValidation(Validator $validator)
    {
        $response = sendResponse($validator->messages()->first(), [], FALSE);
        throw new ValidationException($validator, $response);
    }
}

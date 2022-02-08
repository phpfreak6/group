<?php

namespace App\Http\Requests\GroupMessages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class CreateGroupMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'group_id' => 'required',
            'body' => 'required'
        ];
    }

    function failedValidation(Validator $validator)
    {
        $response = sendResponse($validator->messages()->first(), [], FALSE);
        throw new ValidationException($validator, $response);
    }
}

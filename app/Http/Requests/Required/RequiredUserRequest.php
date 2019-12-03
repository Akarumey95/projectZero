<?php

namespace App\Http\Requests\Required;

use App\Helpers\RequestWorker;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Http\FormRequest;

class RequiredUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = new UserRequest();
        $required = [
            'email' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required',
        ];

        return RequestWorker::merge($rules->rules(), $required);
    }
}

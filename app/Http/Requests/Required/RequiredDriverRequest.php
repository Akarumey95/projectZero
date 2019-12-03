<?php

namespace App\Http\Requests\Required;

use App\Helpers\RequestWorker;
use App\Http\Requests\DriverRequest;
use Illuminate\Foundation\Http\FormRequest;

class RequiredDriverRequest extends FormRequest
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
        $rules = new DriverRequest();
        $required = [
            'phone' => 'required',
            'city' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ];
        $required = RequestWorker::merge($rules->rules(), $required);

        $rules = new RequiredUserRequest();
        $required = RequestWorker::merge($rules->rules(), $required);

        return $required;
    }
}

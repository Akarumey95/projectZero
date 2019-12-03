<?php

namespace App\Http\Requests\Required;

use App\Helpers\RequestWorker;
use App\Http\Requests\PassengerRequest;
use Illuminate\Foundation\Http\FormRequest;

class RequiredPassengerRequest extends FormRequest
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
        $rules = new PassengerRequest();
        $required = [
            'phone' => 'required',
            'card_number' => 'required',
            'card_expiry' => 'required',
            'card_cvc' => 'required',
        ];
        $required = RequestWorker::merge($rules->rules(), $required);

        $rules = new RequiredUserRequest();
        $required = RequestWorker::merge($rules->rules(), $required);

        return $required;
    }
}

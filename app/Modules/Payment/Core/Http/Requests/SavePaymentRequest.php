<?php

namespace App\Modules\Payment\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SavePaymentRequest extends FormRequest
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
        return [
            'earnings'    => 'required|numeric',
            'subearnings' => 'required|numeric',
            'host'        => ['required','numeric', Rule::in([1,2])],
        ];
    }
}

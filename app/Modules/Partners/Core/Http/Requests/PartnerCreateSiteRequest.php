<?php

namespace App\Modules\Partners\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerCreateSiteRequest extends FormRequest
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
            //'domain'  => 'required|string|min:4|max:10|not_in:partner,partners|regex:/^[a-z0-9]+$/i|unique:dropshippers,domain',
            'domain'  => 'required|string|min:4|max:10|not_in:partner,partners|regex:/^[a-z0-9]+$/i',
        ];
    }
}

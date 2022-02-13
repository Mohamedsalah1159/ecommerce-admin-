<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LangRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',

        ];
    }
    public function messages(){
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيمه المدخله غير صحيحه',
            'name.string' => 'اسم اللغه لابد ان يكون احرف',
            'name.max' => 'اسم اللغه لا يمكن ان يتعدي 100حرف',
            'abbr.max' => 'هذا الحقل  لا بد ان يزيد عن 10احرف',
            'abbr.string' => 'هذا الحقل لابد ان يكون احرف',
        ];
    }
}

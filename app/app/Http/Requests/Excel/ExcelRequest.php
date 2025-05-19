<?php

namespace App\Http\Requests\Excel;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    
    public function rules(): array
    {
        return [
            'file' => 'required|file|extensions:xls,xlsx'
        ];
    }
}

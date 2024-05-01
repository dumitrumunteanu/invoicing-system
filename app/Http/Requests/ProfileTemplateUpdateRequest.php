<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileTemplateUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'template_id' => ['required', 'integer', 'min:1', 'max:3'],
        ];
    }
}

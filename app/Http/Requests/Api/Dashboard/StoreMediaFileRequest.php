<?php

namespace App\Http\Requests\Api\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaFileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => [
                'required',
                'mimes:png,jpg,jpeg,webp,svg,mp4,avi,pdf,docx',
                'max:10240'
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'file_link' => [
                'nullable',
                'url'
            ],
            'is_link' => [
                'nullable',
                'integer',
                'in:1,0'
            ],
            'file_type' => [
                'nullable',
                'string',
                'in:file,video,image'
            ]
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'image' => 'image|max:2048',
            'files.*.image' => 'required|image|max:2048',
        ];
    }

    public function messages() {
        return [
        'image' => '指定されたファイルが画像ではありません。',
        'max' => 'ファイルサイズは2MB以内にしてください。',
        'required' => '画像を指定してください'
        ];
    }
}

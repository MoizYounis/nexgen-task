<?php

namespace App\Http\Requests;

use App\Abstracts\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:csv'
        ];
    }

    public function prepareRequest()
    {
        $request = $this;
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        return [
            'usersData' => $fileContents
        ];
    }
}

<?php

namespace Modules\CircleNotes\App\Http\Requests\CircleXoNote;

use Illuminate\Foundation\Http\FormRequest;

class CircleXoNoteUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return has_app('circle-notes', $this->model['account_id']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'nullable|max:255|string',
            'content' => 'required|string',
            'is_public' => 'sometimes|boolean',
        ];
    }
}

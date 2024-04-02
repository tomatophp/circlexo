<?php

namespace Modules\CircleDocs\App\Http\Requests\CircleXoDocsPage;

use Illuminate\Foundation\Http\FormRequest;

class CircleXoDocsPageStoreRequest extends FormRequest
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
            'cover' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,webp,svg',
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:255|string',
            'body' => 'required',
            'parent_id' => 'nullable',
            'icon' => 'nullable|max:255|string',
            'color' => 'nullable|max:255|string',
            'slug' => 'nullable|max:255|string',
            'doc_id' => 'required|exists:circle_xo_docs,id'
        ];
    }
}

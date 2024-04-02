<?php

namespace Modules\CircleDocs\App\Http\Requests\CircleXoDoc;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CircleDocs\App\Models\CircleXoDoc;

class CircleXoDocStoreRequest extends FormRequest
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
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|max:255|string',
            'package' => ['required','max:255','string','regex:/\w*$/', function ($attribute, $value, $fail) {
                $exists = CircleXoDoc::query()
                    ->where('account_id', auth('accounts')->user()->id)
                    ->where('package', $value)
                    ->first();

                if($exists){
                    $fail('The '.$attribute.' is already in use.');
                }
            }],
            'about' => 'nullable',
            'repository' => 'nullable|max:255|string',
            'branch' => 'nullable|max:255|string',
            'readme' => 'nullable',
            'is_active' => 'nullable',
            'is_public' => 'nullable'
        ];
    }
}

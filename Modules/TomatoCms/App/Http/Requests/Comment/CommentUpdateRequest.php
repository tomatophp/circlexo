<?php

namespace Modules\TomatoCms\App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
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
            'account_id' => 'sometimes|exists:accounts,id',
            'post_id' => 'sometimes|exists:posts,id',
            'comment' => 'sometimes|max:65535',
            'activated' => 'sometimes'
        ];
    }
}

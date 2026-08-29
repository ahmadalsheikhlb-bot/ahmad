<?php

namespace App\Http\Requests;

//use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateNoteRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
    'user_id'      => ['required', 'exists:users,id'],
    'topic_id'     => ['required', 'exists:topics,id'],
    'title'        => ['required', 'string', 'max:255'],
    'content'      => ['required', 'string'],
    'visibility'   => ['nullable', 'string', 'in:public,private,shared'], 
    'status'       => ['nullable', 'string', 'in:draft,published,archived'], 
    'published_at' => ['nullable', 'date'],
    'archived_at'  => ['nullable', 'date', 'after_or_equal:published_at'],

        ];
    }
}

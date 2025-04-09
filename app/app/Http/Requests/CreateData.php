<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateData extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->routeIs('create.thread')) {
            return ['name' => 'required'];
        } elseif ($this->routeIs('create.comment')) {
            return [
                'content' => 'required',
                'image' => 'nullable|image|max:4096'
            ];
        }

        return [];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        return [
            'title' =>  'required|max:255',
            'cate_id'   =>  'required|integer',
            'contents'  =>  'required|max:3000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' =>  '请输入标题',
            'cate_id.required'   =>  '请选择分类',
            'contents.required'  =>  '请输入内容'
        ];
    }
}

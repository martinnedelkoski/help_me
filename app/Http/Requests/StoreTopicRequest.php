<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class StoreTopicRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'category' => 'required'
        ];
    }
}

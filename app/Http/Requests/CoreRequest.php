<?php

namespace App\Http\Requests;

use App\Classes\Reply;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class CoreRequest extends FormRequest
{
    protected function formatErrors(Validator $validator)
    {
        return Reply::formErrors($validator);
    }

    public function forbiddenResponse()
    {
        return new Response('You are not authorised', 403);
    }
}

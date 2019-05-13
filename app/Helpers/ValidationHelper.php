<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Validator;

class ValidationHelper
{
    /**
     * @param $data
     * @param bool $update
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function getPodcastValidator($data, $update = false)
    {

        return Validator::make($data, [
            'name' => ($update) ? 'sometimes|required|unique:podcasts|min:4' : 'required|unique:podcasts|min:4',
            'description' => 'max:1000',
            'feed_url' => 'required|url',
            'marketing_url' => 'url',
            'image' => 'base64_format'
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function getCommentValidator($data){
        return Validator::make($data, [
            'author_name' => 'required',
            'author_email' => 'required|email',
            'comment' => 'required',
            'podcast_id' => 'required',
        ]);
    }
}
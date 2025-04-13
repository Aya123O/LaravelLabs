<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Post;

class MaxThreeComments implements Rule
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function passes($attribute, $value)
    {
        return $this->post->comments()->count() < 3;
    }

    public function message()
    {
        return 'Each post is limited to 3 comments maximum.';
    }
}
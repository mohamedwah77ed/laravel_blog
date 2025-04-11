<?php

use Illuminate\Support\Str;

if (!function_exists('convertHashtagsToLinks')) {
    function convertHashtagsToLinks($text)
    {
        return preg_replace_callback('/#(\w+)/', function ($matches) {
            $tag = $matches[1]; 
            return '<a href="' . route('posts.search', ['tag' => $tag]) . '">#' . $tag . '</a>';
        }, e($text));
    }
}

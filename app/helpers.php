<?php

use Overtrue\Pinyin\Pinyin;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
function theme_nav_active($theme_id)
{
    return active_class((if_route('themes.show') && if_route_param('theme', $theme_id)));
}
//function make_excerpt($value, $length = 200)
//{
//    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
//    return Str::limit($excerpt, $length);
//}
function getAppName()
{
    return config('app.name');
}
//function pinyin($text)
//{
//    return \Str::slug(app(Pinyin::class)->permalink($text));
//}
function pinyin(String $string) {

    return implode((new Pinyin)->convert($string, PINYIN_KEEP_ENGLISH));
}

function positionToSlugs(\App\Models\Position $position, $is_pinyin = true)
{
    return (new \App\Services\PositionService)->positionToSlugs($position, $is_pinyin);
}

function positionToProvinceSlugs(\App\Models\Position $position, $is_pinyin = true)
{
    return (new \App\Services\PositionService)->positionToProvinceSlugs($position, $is_pinyin);
}

function idToSlugs($id, $is_pinyin = true)
{
    return (new \App\Services\PositionService)->idToSlugs($id, $is_pinyin);
}

function idToProvinceSlugs($id, $is_pinyin = true)
{
    return (new \App\Services\PositionService)->idToProvinceSlugs($id, $is_pinyin);
}
<?php
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
function theme_nav_active($theme_id)
{
    return active_class((if_route('themes.show') && if_route_param('theme', $theme_id)));
}
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}
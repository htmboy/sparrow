<?php
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
function theme_nav_active($theme_id)
{
    return active_class((if_route('themes.show') && if_route_param('theme', $theme_id)));
}
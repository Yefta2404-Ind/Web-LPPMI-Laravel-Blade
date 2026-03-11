<?php

use Illuminate\Support\Facades\Route;

function menu_url($menu)
{
    if ($menu->page) {
        return url($menu->page->slug);
    }
    if (!empty($menu->url)) {
        return $menu->url;
    }
    return url('/');
}
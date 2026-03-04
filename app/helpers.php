<?php

use Illuminate\Support\Facades\Route;

function menu_url($menu)
{
    return $menu->page
        ? url($menu->page->slug)
        : url('/');
}
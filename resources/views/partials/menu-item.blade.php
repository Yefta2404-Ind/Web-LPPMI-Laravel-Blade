@foreach($menus as $menu)
    <li class="{{ $menu->childrenRecursive->count() ? 'nav-dropdown' : '' }}">
        
        <a href="{{ $menu->childrenRecursive->count() ? '#' : menu_url($menu) }}"
           class="nav-link {{ $menu->childrenRecursive->count() ? 'nav-toggle' : '' }}">
           
            {{ strtoupper($menu->title) }}

            @if($menu->childrenRecursive->count())
                <i class="fas fa-chevron-down"></i>
            @endif
        </a>

        @if($menu->childrenRecursive->count())
            <ul class="nav-submenu">
                @include('partials.menu-item', ['menus' => $menu->childrenRecursive])
            </ul>
        @endif

    </li>
@endforeach
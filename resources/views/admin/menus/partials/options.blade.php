@foreach($menus as $menu)
    <option value="{{ $menu->id }}" {{ old('parent_id') == $menu->id ? 'selected' : '' }}>
        {{ str_repeat('— ', $level) }}{{ $menu->title }}
    </option>

    @if($menu->childrenRecursive && $menu->childrenRecursive->count() > 0)
        @include('admin.menus.partials.options', [
            'menus' => $menu->childrenRecursive,
            'level' => $level + 1
        ])
    @endif
@endforeach
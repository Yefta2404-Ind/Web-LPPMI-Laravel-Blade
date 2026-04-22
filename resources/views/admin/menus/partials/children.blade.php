@foreach($children as $child)
<div class="menu-item child-item level-{{ $level }}" 
     data-id="{{ $child->id }}" 
     data-parent="{{ $parentId }}">
    
    <div class="menu-item-content">
        <div class="drag-handle-placeholder"></div>
        
        <div class="menu-info">
            <div class="menu-title-section">
                @if($child->childrenRecursive && $child->childrenRecursive->count() > 0)
                <button class="collapse-toggle" data-parent="{{ $child->id }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>
                @else
                <div style="width: 16px;"></div>
                @endif
                <div class="menu-title">
                    <span class="title-text">{{ $child->title }}</span>
                    @if($child->childrenRecursive && $child->childrenRecursive->count() > 0)
                    <span class="child-count-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                        </svg>
                        {{ $child->childrenRecursive->count() }} sub
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="menu-meta">
                <div class="meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                    </svg>
                    <span>
                        @if($child->page)
                            {{ $child->page->title }}
                        @elseif($child->url)
                            {{ \Illuminate\Support\Str::limit($child->url, 30) }}
                        @else
                            <span class="text-muted">Tidak ada URL</span>
                        @endif
                    </span>
                </div>
                <div class="meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18M3 12h18M3 18h18"/>
                    </svg>
                    <span>Parent: {{ $child->parent?->title ?? 'Utama' }}</span>
                </div>
                <div class="meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="16"/>
                        <line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                    <span>Urutan: {{ $child->order }}</span>
                </div>
            </div>
        </div>
        
        <div class="menu-actions">
            <label class="toggle-switch">
                <input type="checkbox" class="toggle-active" data-id="{{ $child->id }}" {{ $child->is_active ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
            <span class="status-text {{ $child->is_active ? 'active' : 'inactive' }}">
                {{ $child->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
            
            <div class="action-buttons">
                <a href="{{ route('admin.menus.edit', $child) }}" class="action-btn edit-btn" title="Edit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                        <path d="M4 20h16"/>
                    </svg>
                </a>
                <button type="button" class="action-btn delete-btn btn-open-delete" title="Hapus"
                        data-id="{{ $child->id }}"
                        data-title="{{ $child->title }}"
                        data-url="{{ route('admin.menus.destroy', $child) }}"
                        data-children='@json($child->childrenRecursive)'>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

@if($child->childrenRecursive && $child->childrenRecursive->count() > 0)
    @include('admin.menus.partials.children', [
        'children' => $child->childrenRecursive, 
        'parentId' => $child->id, 
        'level' => $level + 1
    ])
@endif
@endforeach
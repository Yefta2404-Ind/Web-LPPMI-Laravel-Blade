{{-- resources/views/components/popup-banner.blade.php --}}
@php
    $popup = \App\Models\PopupBanner::getActive();
@endphp

@if($popup)
<!-- Overlay -->
<div id="popup-overlay" style="
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.65);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
">
    <!-- Box -->
    <div style="position: relative; max-width: 620px; width: 100%;">

        <!-- Tombol ✕ persis seperti di gambar -->
        <button onclick="document.getElementById('popup-overlay').remove()" style="
            position: absolute; top: -14px; right: -14px;
            width: 30px; height: 30px;
            background: #f5a623; color: white;
            border: none; border-radius: 50%;
            font-size: 18px; font-weight: bold;
            cursor: pointer; z-index: 10000;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        ">✕</button>

        <!-- Gambar -->
        <img src="{{ Storage::url($popup->image_path) }}"
             alt="Informasi LPMI"
             style="width: 100%; border-radius: 8px; display: block;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.4);">
    </div>
</div>

<!-- Tutup kalau klik di luar -->
<script>
    document.getElementById('popup-overlay')?.addEventListener('click', function(e) {
        if (e.target === this) this.remove();
    });
</script>
@endif
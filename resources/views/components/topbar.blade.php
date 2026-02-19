<div class="d-flex justify-content-between align-items-center">
<h5 class="fw-semibold">@yield('title')</h5>
<span class="text-muted">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
</div>
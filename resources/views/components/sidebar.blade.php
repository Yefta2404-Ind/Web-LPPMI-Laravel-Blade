<div class="sidebar">
<h4 class="text-center py-3">CMS KAMPUS</h4>


<a href="{{ route('dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
<a href="{{ route('news.create') }}"><i class="fa fa-newspaper me-2"></i> Buat Berita</a>
<a href="{{ route('agenda.create') }}"><i class="fa fa-calendar me-2"></i> Buat Agenda</a>


@if(in_array(auth()->user()->role, ['admin','superadmin']))
<hr class="text-white">
<a href="{{ route('admin.dashboard') }}"><i class="fa fa-user-shield me-2"></i> Admin Panel</a>
@endif


<hr class="text-white">
<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="btn btn-link text-white w-100 text-start px-4">Logout</button>
</form>
</div>
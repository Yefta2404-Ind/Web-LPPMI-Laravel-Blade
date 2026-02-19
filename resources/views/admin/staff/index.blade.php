@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Kelola Staff</h1>

    {{-- Notifikasi --}}
    @if(session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" id="status-alert">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('admin.staff.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Tambah Staff
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Verified</th>
                    <th class="px-4 py-2 border">Created</th>
                    <th class="px-4 py-2 border">Updated</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staffs as $staff)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $staff->id }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $staff->name }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $staff->email }}
                        </td>

                        <td class="px-4 py-2 border capitalize">
                            {{ $staff->role }}
                        </td>

                        <td class="px-4 py-2 border">
                            @if($staff->email_verified_at)
                                {{ $staff->email_verified_at->format('d-m-Y H:i') }}
                            @else
                                <span class="text-red-500">Belum Verifikasi</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $staff->created_at->format('d-m-Y H:i') }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ $staff->updated_at->format('d-m-Y H:i') }}
                        </td>

                        <td class="px-4 py-2 border text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.staff.edit', $staff) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    Edit
                                </a>

                                <form action="{{ route('admin.staff.destroy', $staff) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus staff ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-4 text-center text-gray-500">
                            Belum ada staff.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Auto Fade Notification --}}
<script>
    const statusAlert = document.getElementById('status-alert');
    if(statusAlert){
        setTimeout(()=>{
            statusAlert.style.transition="opacity 0.5s";
            statusAlert.style.opacity = 0;
            setTimeout(()=>statusAlert.remove(),500);
        },5000);
    }
</script>
@endsection

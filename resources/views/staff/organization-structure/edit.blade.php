@extends('layouts.staff')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Struktur Organisasi</h4>

    <form action="{{ route('staff.organization-structure.update', $structure->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Struktur</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ $structure->title }}"
                   required>
        </div>

        <hr>

        <h5>Anggota</h5>

        <div id="members">
            @foreach($structure->members as $i => $member)
            <div class="member border p-3 mb-3">

                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text"
                           name="members[{{ $i }}][name]"
                           value="{{ $member->name }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-2">
                    <label>Jabatan</label>
                    <input type="text"
                           name="members[{{ $i }}][position]"
                           value="{{ $member->position }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-2">
                    <label>Foto Baru (opsional)</label>
                    <input type="file"
                           name="members[{{ $i }}][photo]"
                           class="form-control">
                </div>

            </div>
            @endforeach
        </div>

        <button type="button"
                class="btn btn-outline-secondary mb-3"
                onclick="addMember()">
            + Tambah Anggota
        </button>

        <br>

        <button class="btn btn-primary">
            Simpan Perubahan
        </button>
    </form>
</div>

<script>
let index = {{ $structure->members->count() }};

function addMember() {
    const html = `
    <div class="member border p-3 mb-3">
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="members[${index}][name]"
                   class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Jabatan</label>
            <input type="text" name="members[${index}][position]"
                   class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Foto</label>
            <input type="file"
                   name="members[${index}][photo]"
                   class="form-control">
        </div>
    </div>
    `;
    document.getElementById('members')
        .insertAdjacentHTML('beforeend', html);
    index++;
}
</script>
@endsection

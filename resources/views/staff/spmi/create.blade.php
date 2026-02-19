@extends('layouts.cms')

@section('title','Upload Dokumen SPMI')

@section('content')
<div class="container-spmi">

    <div class="page-header">
        <h2>Upload Dokumen SPMI</h2>
        <p>Status awal: <span class="badge pending">Pending</span> (menunggu approval admin)</p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.spmi.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="spmi-form">
    @csrf

@foreach($categories as $category)
    <div class="form-group">
        <label>{{ $category->name }}</label>

        <textarea name="descriptions[{{ $category->id }}]"
                  rows="3"
                  placeholder="Deskripsi untuk kategori ini"></textarea>

        <input type="file"
               name="documents[{{ $category->id }}][]"
               multiple>

        <small>Maksimal 5MB per file</small>
    </div>
@endforeach


    <div class="form-actions">
        <button type="submit" class="btn-submit">
            Upload Semua
        </button>
    </div>
</form>


</div>
<style>

    .container-spmi {
    max-width: 700px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.page-header {
    margin-bottom: 25px;
}

.page-header h2 {
    margin: 0 0 5px;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    color: white;
}

.pending {
    background: orange;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 14px;
}

.divider {
    text-align: center;
    margin: 20px 0;
    color: #888;
}

.divider span {
    background: #fff;
    padding: 0 10px;
}

.form-actions {
    text-align: right;
}

.btn-submit {
    background: #2c5282;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-submit:hover {
    background: #1a365d;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
}
<script>
document.querySelector('input[name="file"]').addEventListener('change', function(){
    if(this.files.length > 0){
        document.querySelector('input[name="external_link"]').disabled = true;
    }
});
</script>

</style>
@endsection


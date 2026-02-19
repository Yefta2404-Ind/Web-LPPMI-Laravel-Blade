<div class="mb-3">
<label class="form-label">Nama Lengkap</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
value="{{ old('name', $data->name ?? '') }}" required>
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>


<div class="mb-3">
<label class="form-label">Jabatan</label>
<input type="text" name="position" class="form-control @error('position') is-invalid @enderror"
value="{{ old('position', $data->position ?? '') }}" required>
@error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>


<div class="mb-3">
<label class="form-label">Urutan Tampilan</label>
<input type="number" name="order" class="form-control"
value="{{ old('order', $data->order ?? 0) }}">
</div>


<div class="mb-3">
<label class="form-label">Foto</label>
<input type="file" name="photo" class="form-control">


@isset($data)
@if($data->photo)
<div class="mt-2">
<img src="{{ asset('storage/'.$data->photo) }}" width="120" class="rounded">
</div>
@endif
@endisset
</div>
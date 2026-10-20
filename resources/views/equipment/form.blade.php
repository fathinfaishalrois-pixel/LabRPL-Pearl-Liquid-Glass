@extends('layouts.app')
@section('title', $equipment->exists?'Edit Alat':'Tambah Alat')
@section('heading', $equipment->exists?'Edit Data Alat':'Tambah Alat')
@section('subtitle','Pastikan kode inventaris dan jumlah stok sesuai kondisi laboratorium.')
@section('content')
<div class="card" style="max-width:850px"><form method="POST" action="{{ $equipment->exists?route('alat.update',$equipment):route('alat.store') }}">@csrf @if($equipment->exists)@method('PUT')@endif
<div class="form-grid">
<div class="field"><label>Kode alat</label><input class="input" name="code" value="{{ old('code',$equipment->code) }}" placeholder="ALT-001" required></div>
<div class="field"><label>Nama alat</label><input class="input" name="name" value="{{ old('name',$equipment->name) }}" placeholder="Arduino Uno R3" required></div>
<div class="field"><label>Kategori</label><input class="input" name="category" value="{{ old('category',$equipment->category) }}" placeholder="Jaringan / Elektronika" required></div>
<div class="field"><label>Stok unit</label><input class="input" type="number" min="0" name="stock" value="{{ old('stock',$equipment->stock ?? 0) }}" required></div>
<div class="field"><label>Kondisi</label><select class="select" name="condition" required>@foreach(['baik'=>'Baik','perlu_perbaikan'=>'Perlu perbaikan','rusak'=>'Rusak'] as $value=>$label)<option value="{{ $value }}" @selected(old('condition',$equipment->condition??'baik')===$value)>{{ $label }}</option>@endforeach</select></div>
</div><div class="form-actions"><a class="btn ghost" href="{{ route('alat.index') }}">Batal</a><button class="btn" type="submit">Simpan data →</button></div>
</form></div>
@endsection

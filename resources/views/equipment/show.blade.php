@extends('layouts.app')
@section('title','Detail Alat')
@section('heading',$equipment->name)
@section('subtitle','Detail inventaris laboratorium.')
@section('content')
<div class="card" style="max-width:700px"><div class="stats" style="grid-template-columns:repeat(2,minmax(0,1fr))"><div><div class="stat-label">Kode alat</div><div class="stat-value" style="font-size:23px">{{ $equipment->code }}</div></div><div><div class="stat-label">Stok tersedia</div><div class="stat-value" style="font-size:23px">{{ $equipment->stock }} unit</div></div></div><p><strong>Kategori:</strong> {{ $equipment->category }}</p><p><strong>Kondisi:</strong> <span class="badge {{ $equipment->condition }}">{{ str_replace('_',' ',ucfirst($equipment->condition)) }}</span></p><div class="form-actions"><a class="btn ghost" href="{{ route('alat.index') }}">Kembali</a><a class="btn" href="{{ route('alat.edit',$equipment) }}">Edit alat</a></div></div>
@endsection

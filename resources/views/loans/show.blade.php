@extends('layouts.app')
@section('title','Detail Peminjaman')
@section('heading','Detail Peminjaman')
@section('subtitle','Periksa item dan kelola status transaksi.')
@section('content')
<div class="card" style="margin-bottom:20px"><div class="section-title"><div><h2>Transaksi #{{ $loan->id }}</h2><p>Diajukan oleh {{ $loan->user->name }} ({{ $loan->user->email }})</p></div><span class="badge {{ $loan->status }}">{{ ucfirst($loan->status) }}</span></div>
<div class="form-grid"><div><div class="stat-label">Tanggal pinjam</div><strong>{{ $loan->loan_date->format('d M Y') }}</strong></div><div><div class="stat-label">Rencana kembali</div><strong>{{ $loan->due_date->format('d M Y') }}</strong></div></div>
@if($loan->notes)<p class="sub">Catatan: {{ $loan->notes }}</p>@endif
<div class="table-wrap" style="margin-top:22px"><table><thead><tr><th>ALAT</th><th>KODE</th><th>JUMLAH</th></tr></thead><tbody>@foreach($loan->items as $item)<tr><td>{{ $item->equipment->name }}</td><td>{{ $item->equipment->code }}</td><td>{{ $item->quantity }}</td></tr>@endforeach</tbody></table></div>
@if(auth()->user()->role==='admin' && $loan->status==='menunggu')<div class="toolbar" style="margin-top:20px"><form method="POST" action="{{ route('peminjaman.status',$loan) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="disetujui"><button class="btn success" type="submit">✓ Setujui peminjaman</button></form><form method="POST" action="{{ route('peminjaman.status',$loan) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="ditolak"><button class="btn danger" type="submit">Tolak</button></form></div>@endif
@if(auth()->user()->role!=='admin' && in_array($loan->status,['menunggu','ditolak']))<form method="POST" action="{{ route('peminjaman.destroy',$loan) }}" onsubmit="return confirm('Batalkan pengajuan ini?')" style="margin-top:20px">@csrf @method('DELETE')<button class="btn danger" type="submit">Batalkan pengajuan</button></form>@endif
@if($loan->returnRecord)<div class="alert success" style="margin-top:20px">Dikembalikan {{ $loan->returnRecord->returned_at->format('d M Y H:i') }} · Kondisi: {{ str_replace('_',' ',$loan->returnRecord->condition) }}</div>@endif
<div class="form-actions"><a class="btn ghost" href="{{ route('peminjaman.index') }}">Kembali ke daftar</a>@if(auth()->user()->role==='admin' && $loan->status==='disetujui')<a class="btn" href="{{ route('pengembalian.create',$loan) }}">Proses pengembalian →</a>@endif</div></div>
@endsection

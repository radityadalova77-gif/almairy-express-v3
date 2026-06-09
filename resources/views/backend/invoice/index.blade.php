@extends('backend.layouts.app')

@section('title', 'Invoice')
@section('page-title', 'Invoice Management')

@section('topbar-actions')

@if(in_array(auth()->user()->role->nama, ['admin','operasional']))
<button class="btn btn-primary" onclick="openModal('add-invoice')">
    + Buat Invoice
</button>
@endif

@endsection

@section('content')

{{-- STAT --}}
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-label">Total Invoice</div>
        <div class="stat-value">{{ number_format($totalInvoice ?? 0) }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Sudah Lunas</div>
        <div class="stat-value">{{ number_format($lunas ?? 0) }}</div>
        <div class="stat-change text-muted">{{ $pctLunas ?? 0 }}% dari total</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Outstanding</div>
        <div class="stat-value text-red">{{ number_format($outstanding ?? 0) }}</div>
        <div class="stat-change text-muted">Perlu follow up</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Revenue</div>
        <div class="stat-value">Rp {{ number_format($revenue ?? 0, 0, ',', '.') }}</div>
    </div>

</div>

{{-- FILTER --}}
<div class="card">
    <form method="GET" class="flex justify-between align-center">
        <div class="flex gap8">
            <input type="text" name="search" placeholder="Cari invoice / customer" value="{{ request('search') }}">

            <select name="status">
                <option value="">Semua Status</option>
                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>

            <button type="submit" class="btn">Filter</button>
        </div>
    </form>
</div>

{{-- TABLE --}}
<div class="card">
    <div class="card-title">Daftar Invoice</div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No Invoice</th>
                    <th>Pelanggan</th>
                    <th>Tagihan</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($invoice as $inv)
                <tr>
                    <td>{{ $inv->no_invoice }}</td>
                    <td>{{ $inv->pelanggan?->nama_perusahaan }}</td>
                    <td>Rp {{ number_format($inv->nominal, 0, ',', '.') }}</td>
                    <td>{{ optional($inv->jatuh_tempo)->format('d M Y') }}</td>

                    <td>
                        @php
                        $statusMap = [
                        'lunas' => 's-lunas',
                        'overdue' => 's-overdue',
                        'pending' => 's-pending',
                        ];
                        @endphp
                        <span class="status {{ $statusMap[$inv->status] ?? '' }}">
                            {{ ucfirst($inv->status) }}
                        </span>
                    </td>

                    <td class="flex gap4">

                        <a href="{{ route('invoice.print',$inv->id) }}" class="btn btn-xs">
                            Detail
                        </a>

                        <a href="{{ route('invoice.export', $inv->id) }}" class="btn btn-success">Export</a>

                        @if($inv->status === 'lunas')

                        <a href="{{ route('invoice.pdf',$inv->id) }}" class="btn btn-xs btn-success">
                            PDF
                        </a>

                        @elseif($inv->status === 'overdue')

                        <button class="btn btn-xs btn-warn" onclick="sendReminder(this.dataset.id)">
                            Reminder
                        </button>

                        @elseif($inv->status === 'pending')

                        @if(auth()->user()->role->nama == 'admin')
                        <button class="btn btn-xs btn-danger" data-id="{{ $inv->id }}"
                            onclick="confirmVoid(this.dataset.id)">
                            Void
                        </button>
                        @endif

                        @if(in_array(auth()->user()->role->nama, ['admin','operasional']))
                        <form action="{{ url('/invoice/'.$inv->id.'/bayar') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-success" style="padding:6px 12px;">
                                Lunas
                            </button>
                        </form>
                        @endif

                        @endif

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:var(--muted)">
                        Tidak ada data invoice.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="pagination">
        {{ $invoice->withQueryString()->links() }}
    </div>
</div>

{{-- AGING --}}
<div class="card">
    <div class="card-title">Aging Receivable</div>
    <table>
        <thead>
            <tr>
                <th>Range</th>
                <th>Invoice</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($aging ?? [] as $row)
            <tr>
                <td>{{ $row['range'] }}</td>
                <td>{{ $row['count'] }}</td>
                <td>Rp {{ number_format($row['nominal'], 0, ',', '.') }}</td>
                <td><span class="status {{ $row['class'] }}">{{ $row['status'] }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('modals')


@if(in_array(auth()->user()->role->nama, ['admin','operasional']))
{{-- ADD INVOICE --}}
<div id="modal-add-invoice" class="modal-overlay hidden">
    <div class="modal">

        <div class="modal-header">
            <div class="modal-title">Buat Invoice</div>
            <button class="modal-close" onclick="closeModal('add-invoice')">×</button>
        </div>

        <form method="POST" action="{{ route('invoice.store') }}">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>Pengiriman *</label>
                    <select name="pengiriman_ids[]" multiple required style="height:120px">
                        @foreach($pengiriman ?? [] as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->resi }} - {{ $p->kota_tujuan }}
                        </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Tekan CTRL / SHIFT untuk pilih banyak</small>
                </div>

                <div class="form-group">
                    <label>Pelanggan *</label>
                    <select name="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan ?? [] as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->nama_perusahaan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- ✅ DIUBAH: tidak input manual lagi --}}
                <div class="form-group">
                    <label>Total (Otomatis)</label>
                    <input type="text" value="Akan dihitung otomatis" readonly>
                </div>

                <div class="form-group">
                    <label>Tanggal Invoice *</label>
                    <input type="date" name="tanggal_invoice" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Jatuh Tempo *</label>
                    <input type="date" name="jatuh_tempo" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="lunas">Lunas</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" onclick="closeModal('add-invoice')">
                    Batal
                </button>

                <button class="btn btn-primary">
                    Simpan Invoice
                </button>
            </div>

        </form>

    </div>
</div>
@endif

{{-- DETAIL --}}
@foreach($invoice as $inv)
<div id="modal-detail-{{ $inv->id }}" class="modal-overlay hidden">
    <div class="modal">

        <div class="modal-header">
            <div class="modal-title">Detail Invoice</div>
            <button class="modal-close" onclick="closeModal('detail-{{ $inv->id }}')">×</button>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>No Invoice</label>
                <input value="{{ $inv->no_invoice }}" readonly>
            </div>

            <div class="form-group">
                <label>Pelanggan</label>
                <input value="{{ $inv->pelanggan?->nama_perusahaan }}" readonly>
            </div>

            <div class="form-group">
                <label>Nominal</label>
                <input value="Rp {{ number_format($inv->nominal,0,',','.') }}" readonly>
            </div>

            <div class="form-group">
                <label>Status</label>
                <input value="{{ ucfirst($inv->status) }}" readonly>
            </div>

            <div class="form-group full">
                <label>Tanggal</label>
                <input value="{{ $inv->tanggal_invoice }}" readonly>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn" onclick="closeModal('detail-{{ $inv->id }}')">Tutup</button>
        </div>

    </div>
</div>
@endforeach

@endsection
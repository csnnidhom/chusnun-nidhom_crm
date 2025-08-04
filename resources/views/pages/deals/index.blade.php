@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-dark">Daftar Deals</h3>
                <a href="{{ route('deals.create') }}" class="btn btn-primary">+ Tambah Deal</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <form action="{{ route('deals.index') }}" method="GET" class="form-inline mb-3">
                    {{-- Filter Status Deal --}}
                    <select name="status" class="form-control mr-2">
                        <option value="">-- Semua Status Deal --</option>
                        <option value="waiting approval" {{ request('status')=='waiting approval'?'selected':'' }}>Waiting Approval</option>
                        <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                        <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                    </select>

                    <input type="text" name="customer_name" class="form-control mr-2" placeholder="Cari nama customer..." value="{{ request('customer_name') }}">

                    <input type="date" name="start_date" class="form-control mr-2" value="{{ request('start_date') }}">
                    <input type="date" name="end_date" class="form-control mr-2" value="{{ request('end_date') }}">

                    <button class="btn btn-primary mr-2">Filter</button>

                    <a href="{{ route('deals.index') }}" class="btn btn-secondary mr-2">Reset</a>

                    <a href="{{ route('deals.export', request()->query()) }}" class="btn btn-success">
                        Export Excel
                    </a>
                </form>
            </div>
            @include('partials.alert')
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        @if(session('role') == 'manager')
                            <th>Dibuat Oleh</th>
                        @endif
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deals as $deal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $deal->customer->nama }} <br>
                                <small>{{ $deal->customer->kontak }}</small>
                            </td>
                            <td>
                                <ul class="mb-0">
                                    @foreach($deal->items as $item)
                                        <li>
                                            {{ $item->product->nama_produk }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>Rp {{ number_format($deal->total_harga,0,',','.') }}</td>
                            @if(session('role') == 'manager')
                                <td>{{ $deal->user->name }}</td>
                            @endif
                            <td>
                                <span class="badge 
                                    @if($deal->status=='approved') bg-success
                                    @elseif($deal->status=='rejected') bg-danger
                                    @else bg-warning text-light @endif">
                                    {{ $deal->status }}
                                </span>
                            </td>
                            <td>{{ $deal->created_at-> format('d-M-Y')}}</td>
                            <td>
                                <a href="{{ route('deals.show', $deal->id) }}" class="btn btn-warning btn-sm">Rincian</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada deal</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $deals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title','Customer')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-dark">Daftar Customer</h3>
                <a href="{{ route('customers.create') }}" class="btn btn-success">Tambah Lead</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <form action="{{ route('customers.index') }}" method="GET" class="form-inline">
                    <select name="status" class="form-control mr-2">
                        <option value="">-- Semua Status --</option>
                        <option value="lead" {{ request('status')=='lead'?'selected':'' }}>Lead</option>
                        <option value="customer" {{ request('status')=='customer'?'selected':'' }}>Customer</option>
                    </select>
                    <button class="btn btn-primary">Filter</button>
                </form>
            </div>
            @include('partials.alert')
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        @if(session('role') == 'manager')
                            <th>Dibuat Oleh</th>
                        @endif
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>{{ $customer->nama }}</td>
                        <td>{{ $customer->kontak }}</td>
                        <td>{{ $customer->alamat }}</td>
                        <td>{{ $customer->status }}</td>
                        @if(session('role') == 'manager')
                            <td>{{ $customer->user->name }}</td>
                        @endif
                        <td>{{ $customer->created_at-> format('d-M-Y')}}</td>
                        <td>    
                            <button class="btn btn-sm btn-info btn-view"
                                    data-nama="{{ $customer->nama }}"
                                    data-kontak="{{ $customer->kontak }}"
                                    data-alamat="{{ $customer->alamat }}"
                                    data-kebutuhan="{{ $customer->kebutuhan }}"
                                    data-status="{{ $customer->status }}"
                                    data-user="{{ $customer->user->name ?? '-' }}"
                                    data-edit-url="{{ route('customers.edit', $customer->id) }}">
                                View
                            </button>
                            <a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('customers.destroy',$customer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus customers ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    

                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada Customer</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="viewCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detail Customer</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="customer-detail">
                Loading...
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-warning" id="btn-edit-customer">Edit</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>





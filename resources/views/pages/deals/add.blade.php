@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-dark">Tambah Deal Baru</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            <form action="{{ route('deals.store') }}" method="POST">
                @csrf

                {{-- Pilih Customer --}}
                <div class="form-group mb-3">
                    <label for="customer_id">Pilih Customer (Calon Customer)</label>
                    <select name="customer_id" id="customer_id" class="form-control" required>
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->nama }} - {{ $customer->kontak }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tabel Produk --}}
                <h4>Produk yang Dijual</h4>

                @include('partials.alert')
                
                <table class="table table-bordered" id="dealItemsTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Produk</th>
                            <th width="150px">Harga Deal</th>
                            <th width="50px">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="items[0][product_id]" class="form-control product-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach ($products as $p)
                                        <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}">
                                            {{ $p->nama_produk }} (Rp {{ number_format($p->harga_jual,0,',','.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="items[0][harga_deal]" class="form-control price" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-row">&times;</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="addRow" class="btn btn-secondary mb-3">+ Tambah Produk</button>

                {{-- Tombol Simpan --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan Deal</button>
                    <a href="{{ route('deals.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let rowIndex = 1;

    document.querySelector('#dealItemsTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.querySelector('#addRow').addEventListener('click', function() {
        let tbody = document.querySelector('#dealItemsTable tbody');
        let newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="items[${rowIndex}][product_id]" class="form-control product-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $p)
                        <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}">
                            {{ $p->nama_produk }} (Rp {{ number_format($p->harga_jual,0,',','.') }})
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="items[${rowIndex}][harga_deal]" class="form-control price" required></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">&times;</button></td>
        `;
        tbody.appendChild(newRow);
        rowIndex++;
    });
});
</script>
@endpush

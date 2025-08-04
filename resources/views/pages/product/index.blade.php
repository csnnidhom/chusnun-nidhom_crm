@extends('layouts.app')
@section('title','Master Produk')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3  class="m-0 text-dark">Master Produk</h3>
                <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            @include('partials.alert')
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>HPP</th>
                        <th>Margin (%)</th>
                        <th>Harga Jual</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->nama_produk }}</td>
                        <td>Rp {{ number_format($product->hpp,0,',','.') }}</td>
                        <td>{{ $product->margin }}%</td>
                        <td>Rp {{ number_format($product->harga_jual,0,',','.') }}</td>
                        <td>{{ $product->created_at-> format('d-M-Y')}}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada produk</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

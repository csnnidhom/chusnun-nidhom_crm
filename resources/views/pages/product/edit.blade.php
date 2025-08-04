@extends('layouts.app')
@section('title','Edit Produk')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-dark">Edit Produk</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            <form action="{{ route('products.update',$product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="{{ $product->nama_produk }}" required>
                </div>
                <div class="form-group">
                    <label>HPP</label>
                    <input type="number" name="hpp" step="0.01" class="form-control" value="{{ $product->hpp }}" required>
                </div>
                <div class="form-group">
                    <label>Margin (%)</label>
                    <input type="number" name="margin" step="0.01" class="form-control" value="{{ $product->margin }}" required>
                </div>
                <button class="btn btn-success">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

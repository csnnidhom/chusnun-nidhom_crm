@extends('layouts.app')
@section('title','Tambah Customer')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-dark">Tambah Customer</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama " required>
                </div>
                <div class="form-group">
                    <label>Kontak</label>
                    <input type="number" name="kontak" class="form-control" placeholder="Masukkan kontak " required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat ">
                </div>
                <div class="form-group">
                    <label>Kebutuhan</label>
                    <textarea name="kebutuhan" class="form-control" placeholder="Masukkan kebutuhan "></textarea>
                </div>
                <button class="btn btn-success">Simpan</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

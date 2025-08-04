@extends('layouts.app')
@section('title','Edit Customer')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card shadow-sm rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0 text-dark">Edit Customer</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-1">
        <div class="card shadow-sm rounded-3 p-3">
            <form method="POST" action="{{ route('customers.update',$customer->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $customer->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Kontak</label>
                    <input type="text" name="kontak" class="form-control" value="{{ $customer->kontak }}" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $customer->alamat }}" required>
                </div>
                <div class="form-group">
                    <label>Kebutuhan</label>
                    <textarea name="kebutuhan" class="form-control">{{ $customer->kebutuhan }}</textarea>
                </div>
                <button class="btn btn-success">Update</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

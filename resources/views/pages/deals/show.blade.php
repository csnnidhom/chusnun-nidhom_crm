@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Detail Deal</h2>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Customer:</strong> {{ $deal->customer->nama }} </p>
            <p><strong>Alamat:</strong> {{ $deal->customer->alamat }} </p>
            <p><strong>Kontak:</strong> {{ $deal->customer->kontak }} </p>
        </div>
        <div class="col-md-6">
            @if(!empty($deal->customer->kebutuhan))
                <p><strong>Kebutuhan:</strong> {{ $deal->customer->kebutuhan }}</p>
            @endif
            <p>
                <strong>Status:</strong>                                
                <span class="badge 
                    @if($deal->status=='approved') bg-success
                    @elseif($deal->status=='rejected') bg-danger
                    @else bg-warning text-light @endif">
                    {{ $deal->status }}
                </span>
            </p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($deal->total_harga, 0, ',', '.') }}</p>
        </div>
    </div>

    <h3>Daftar Produk</h3>

    @include('partials.alert')
      
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama Produk</th>
                <th>Harga Jual</th>
                <th>Harga Deal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deal->items as $item)
            <tr>
                <td>{{ $item->product->nama_produk }}</td>
                <td>Rp {{ number_format($item->product->harga_jual,0,',','.') }}</td>
                <td>{{ number_format($item->harga_deal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(session('role') == 'manager')
        @if($deal->status == 'waiting approval')
            <div class="d-flex justify-content-between align-items-center mt-4" style="gap: 10px;">
                <form action="{{ route('approvals.update', $deal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success" value="approved" name="status">Approve</button>
                    <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                    <input type="hidden" name="customer_id" value="{{ $deal->customer_id }}">
                </form>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal">Rejected</button>
            </div>
        @endif
    @endif
</div>
@endsection

<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('approvals.update', $deal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <input type="hidden" name="deal_id" value="{{ $deal->id }}">

            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectModalLabel">Tolak Deal</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="notes"><strong>Alasan Penolakan:</strong></label>
                    <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Tulis alasan penolakan..." required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                </div>
            </div>
        </form>
    </div>
</div>
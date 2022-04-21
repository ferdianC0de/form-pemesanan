@extends('layouts.app')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Order Detail
</h2>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
          <a class="btn btn-primary" href="{{ route('order-list') }}">Kembali</a> Detail Order {{ $order->id }}
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pemesan</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: {{ $order->name }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Identitas</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: {{ $order->noId }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">No HP</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: {{ $order->noHp }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tempat Wisata</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: {{ $order->destination()->name }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Pengunjung Dewasa</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: {{ $order->adultPersons }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Pengunjung Anak-anak</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: {{ $order->kidPersons }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Harga Tiket</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: Rp {{ number_format($order->destination()->price, 2)  }}</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Total Bayar</label>
                <div class="col-sm-8">
                  <label class="col-form-label">: Rp {{ number_format($order->totalPrice, 2)  }}</label>
                </div>
            </div>
        </div>
    </div>
@stop

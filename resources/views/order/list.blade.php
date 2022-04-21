@extends('layouts.app')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Order List
</h2>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        Daftar Pesanan
      </div>
      <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">No HP</th>
                <th scope="col">Tanggal Kunjungan</th>
                <th scope="col">Destinasi</th>
                <th > Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$order->name}}</td>
                    <td>{{$order->noHp}}</td>
                    <td>{{date_format(date_create($order->visitDate), 'd/m/Y')}}</td>
                    <td>{{$order->destination()->name}}</td>
                    <td>
                        <a class="btn btn-outline-primary" href="{{ route('order-show', $order->id) }}">Detail</a>
                    </td>
                </tr>
                  @endforeach
            </tbody>
          </table>
      </div>
</div>

@stop

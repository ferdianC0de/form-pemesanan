@extends('layouts.app')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Order Form
</h2>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{ route('order-list') }}">Kembali</a> Form Pemesanan
      </div>
      <div class="card-body">
          <form action="{{ route('form-order-store') }}" method="post">
            @csrf
              {{-- Nama --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" id="name">
                  </div>
              </div>

              {{-- Nomor identitas --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">Nomor Identitas</label>
                  <div class="col-sm-9">
                    <input type="text" name="noId" class="form-control" id="noId">
                  </div>
              </div>

              {{-- No HP --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">No HP</label>
                  <div class="col-sm-9">
                    <input type="text" name="noHp" class="form-control" id="noHp">
                  </div>
              </div>

              {{-- Tempat Wisata --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">Tempat Wisata</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="destination" name="destination">
                        @foreach ($destinations as $d)
                            <option value="{{ $d->id }}" price={{ $d->price }}>{{ $d->name }}</option>
                        @endforeach
                      </select>
                  </div>
              </div>

              {{-- Tanggal Kunjungan --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">Tanggal Kunjungan</label>
                  <div class="col-sm-9">
                    <input class="datepicker form-control" id="datepicker" name="visitDate">
                  </div>
              </div>

              {{-- Pengunjung Dewasa --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">Pengunjung Dewasa</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="adultPersons" name="adultPersons">
                  </div>
              </div>

              {{-- Pengunjung Anak-anak --}}
              <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-3 col-form-label">Pengunjung Anak-anak</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="kidPersons" name="kidPersons">
                  </div>
              </div>

              {{-- Harga Tiket --}}
              <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label">Harga Tiket</label>
                <div class="col-sm-9">
                  <label for="colFormLabel" id="ticketPrice"></label>
                  <input type="hidden" name="ticketPrice" class="form-control">
                </div>
            </div>

            {{-- Total Bayar --}}
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-3 col-form-label">Total Bayar</label>
                <div class="col-sm-9">
                <label for="colFormLabel" id="totalPrice"></label>
                <input type="text" name="totalPrice" class="form-control" hidden>
                </div>
            </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Saya dan/atau rombongan telah membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang telah ditetapkan.
                </label>
              </div>

              <div class="d-flex justify-content-around" style="margin-top: 10px;">
                <button type="button" id="hitung" class="btn btn-secondary btn col-md-3">Hitung Total Bayar</button>
                <button type="submit" class="btn btn-secondary btn col-md-3">Pesan Tiket</button>
                <button type="button" id="cancel" class="btn btn-secondary btn col-md-3">Cancel</button>
              </div>
          </form>
      </div>
</div>
@stop
@push('scripts')
    <script>
        // Create our number formatter.
        var formatter = new Intl.NumberFormat(['ban', 'id'], {
        style: 'currency',
        currency: 'IDR',
        });
        var price = $('option:selected', $('#destination')).attr('price');

        function setPrice() {
            price = $('option:selected', $('#destination')).attr('price');
            $('#ticketPrice').html(() => {
                $('input[name="ticketPrice"]').val(price);
                return formatter.format(price);
            });
        }
        setPrice();
        $('#destination').change(() => {
            setPrice();
        });

         $('#hitung').click(() => {
            var adlt = $('#adultPersons').val() ?? 0;
            var kid = $('#kidPersons').val() ?? 0;

            var aprice = adlt * price;
            var kprice = kid * (price / 2);
            var totalprice = aprice + kprice;

            $('#totalPrice').html(formatter.format(totalprice));
            $('input[name="totalPrice"]').val(totalprice);

            console.log(aprice, kprice);
         });

         $('#cancel').click(() => {
             location.reload();
         })
    </script>
@endpush

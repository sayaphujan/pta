@extends('layouts.adminlte.layout')
  
@section('content')

<style type="text/css">
label {
    font-weight: 500!important;
}    
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-11">
            <h1 class="m-0">Detail Pesanan #{{ $trans->order_id }} </h1>
          </div><!-- /.col -->
          @if(Auth::user()->level == 1)
          <div class="col-sm-1" style="position: float-right">
            <a style="cursor:pointer; color:blue; font-weight:bold; text-decoration: underline;" onclick="window.open('resi/{{ $trans->order_id }}','nama window','width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no')"><i class="fa fa-print"></i></a>
          </div><!-- /.col -->
          @endif
        </div><!-- /.row -->
      </div>
    </section>

      <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form method="post"  action="{{ route('trans.update_status', $trans->order_id) }}"  id="myForm" class="form-horizontal">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                           @if ($message = Session::get('success'))
                              <div class="alert alert-success" role="alert">
                                {{ $message }}
                              </div>
                            @endif
                        </div>
                    </div>
                        @csrf
                        @method('PUT')
                            
                    <div class="row mt-3 mb-3">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Jenis Peruntukan</label>
                          <select name="category" class="form-control @error('category') is-invalid @enderror" id="category" aria-describedby="category" required="required" readonly="readonly">
                            <option value="">-- Pilih Disini --</option>
                            <option value="Niaga" {{ $trans->trans_category == 'Niaga' ? 'selected' : ''}}>Niaga</option>
                            <option value="Sosial" {{ $trans->trans_category == 'Sosial' ? 'selected' : ''}}>Sosial</option>
                            <option value="Pribadi Rumah Tangga" {{ $trans->trans_category == 'Pribadi Rumah Tangga' ? 'selected' : ''}}>Pribadi Rumah Tangga</option>
                          </select>    
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Tujuan Pengiriman</label>
                          <select name="destination" class="form-control @error('destination') is-invalid @enderror" id="destination" aria-describedby="destination" required="required" readonly="readonly">
                            <option value="">-- Pilih Disini --</option>
                            <option data-id="1" value="Dalam Kota" {{ $trans->trans_destination == 'Dalam Kota' ? 'selected' : ''}}>Dalam Kota</option>
                            <option data-id="2" value="Luar Kota" {{ $trans->trans_destination == 'Luar Kota' ? 'selected' : ''}}>Luar Kota</option>
                            <option data-id="3" value="Pengambilan Sendiri" {{ $trans->trans_destination == 'Pengambilan Sendiri' ? 'selected' : ''}}>Pengambilan Sendiri</option>
                          </select> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="hidden" class="form-control" name="price_id" id="price_id"readonly="readonly" value="{{ $trans->price_id }}">
                          <label class="label" for="name">Volume Tangki</label>
                          <select name="volume" class="form-control @error('volume') is-invalid @enderror" id="volume" aria-describedby="volume" required="required" readonly="readonly">
                            <option value="">-- Pilih Disini --</option>
                            @foreach ($price as $price)
                              <option data-id={{ $price->price_id }} value={{ $price->price_volume }}  {{ $trans->price_volume == $price->price_volume ? 'selected' : ''}}>{{ $price->price_volume }}</option>
                            @endforeach
                          </select>    
                        </div>
                      </div>
                    </div>
                
                    <div class="row mt-3 mb-3">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Harga Air</label>
                          <input type="text" class="form-control @error('net_price') is-invalid @enderror" name="net_price" id="net_price" placeholder="Harga Air" readonly="readonly" value="{{ $trans->price_net }}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Biaya Pengiriman</label>
                          <input type="text" class="form-control @error('deliv_price') is-invalid @enderror" name="deliv_price" id="deliv_price" placeholder="Biaya Pengiriman" readonly="readonly" value="{{ $trans->price_deliv }}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Total</label>
                          <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" id="total" placeholder="Total" readonly="readonly" value="{{ $trans->price_sum }}">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <input type="hidden" class="form-control" name="order_id" id="order_id" placeholder="No. Pesanan" readonly="readonly" value="{{ $trans->order_id }}">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="label" for="subject">Nama Pemohon</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Pemohon" required="required" value="{{ $trans->name }}" readonly="readonly">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="subject">No. Telepon</label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="No. Telepon" required="required" value="{{ $trans->trans_phone }}">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <label class="label" for="#">Alamat Pengiriman</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Alamat Pengiriman" required="required" value="{{ $trans->loc_address1 }}>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3" style="display: none;">
                      <div class="col-md-6">
                        <label class="label" for="#">Latitude</label>
                        <input type="text" class="form-control" name="address_latitude" id="address-latitude" value="{{ $trans->loc_lat }}" readonly="readonly" />
                      </div>

                      <div class="col-md-6">
                        <label class="label" for="#">Longitude</label>
                        <input type="text" class="form-control" name="address_longitude" id="address-longitude" value="{{ $trans->loc_lng }}" readonly="readonly" />
                        <!--<ul id="geoData">
                          <li>Latitude: <span id="lat-span"></span></li>
                          <li>Longitude: <span id="lon-span"></span></li>
                        </ul>-->
                      </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <div id="address-map-container" style="width:100%;height:400px; ">
                          <div style="width: 100%; height: 100%" id="map"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <label class="label" for="#">Detail Lokasi Pengiriman</label>
                        <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="detail" cols="30" rows="4" placeholder="Detail Lokasi Pengiriman" value="{{ $trans->loc_address2 }}" readonly="readonly">{{ $trans->loc_address2 }}</textarea>
                      </div>
                    </div>
<!---
                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="#">Foto Lokasi</label>
                          <br/>
                          @if(!empty($trans->loc_img)) <img class="zoom" src="{{ asset('upload/lokasi/'.$trans->loc_img) }}"  width="250px" height="auto">@else <p><b><i>Tidak ada foto</i></b></p> @endif
                        </div>
                      </div>
                    </div>
-->
                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="#">Keterangan Tambahan</label>
                          <input type="text" class="form-control @error('noted') is-invalid @enderror" name="noted" id="noted" placeholder="Keterangan Tambahan" value="{{ $trans->trans_note }}" readonly="readonly">
                        </div>
                       </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Metode Pembayaran</label>
                          <select name="payment" class="form-control @error('payment') is-invalid @enderror" id="payment" aria-describedby="payment" required="required" readonly="readonly">
                            <option value="">-- Pilih Disini --</option>
                            <option value="Tunai"  {{ $trans->payment == 'Tunai' ? 'selected' : ''}}> Bayar di Tempat </option>
                            @foreach ($bank as $bank)
                              <option data-id={{ $bank->bank_id }} value={{ $bank->bank_id }} {{ $trans->payment == $bank->bank_id ? 'selected' : ''}}>{{ $bank->bank_name }} - {{ $bank->bank_num }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3" id="bukti">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Status Pembayaran</label>
                          @if($trans->payment == 'Tunai')
                          <p style="color:blue"><b><i>Pembayaran di Tempat</i></b></p>
                          @elseif($trans->payment_status == '0' && empty($trans->payment_photo))
                          <p style="color:red"><b><i>Belum Dibayar</i></b>
                            @if(Auth()->user()->level == 3)
                              &nbsp;&nbsp;&nbsp;<a href="#" data-target="#modal-default" data-toggle="modal">Kirim Bukti Pembayaran</a></p>
                            @endif
                          @else
                              @if($trans->payment == '1' && $trans->payment_status == '0' && !empty($trans->payment_photo))
                                <p style="color:green"><b><i>Terbayar</i></b> 
                                @if(Auth::user()->level == 1)
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href={{ url('trans/cancel_bayar/'. $trans->order_id) }}><button type="button" class="btn btn-success">Cancel</button>
                                @endif
                              @elseif($trans->payment == '0' && $trans->payment_status == '0' && !empty($trans->payment_photo))
                              <p style="color:gray"><b><i>Bukti Pembayaran Tidak Valid</i></b> 
                                @if(Auth::user()->level == 1)
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href={{ url('trans/cancel_bayar/'. $trans->order_id) }}><button type="button" class="btn btn-success">Cancel</button>
                                @endif
                              @endif
                            <br/><br/>
                           <img class="zoom" src="{{ asset('upload/bukti/'.$trans->payment_photo) }}"  width="250px" height="auto"><br/><br/>
                              @if(Auth()->user()->level == 3 && $trans->payment_status == 0)
                              &nbsp;&nbsp;&nbsp;<a href="#" data-target="#modal-default" data-toggle="modal">Kirim Ulang Bukti Pembayaran</a></p>
                              @endif
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                        
                          <label class="label" for="name">Petugas Pengiriman</label>
                          <select name="driver" class="form-control @error('driver') is-invalid @enderror" id="driver" aria-describedby="driver" required="required" @if($trans->driver_id >0 || Auth()->user()->level !=  1) readonly="readonly" @endif>
                            <option value="">
                            @if($trans->driver_id == 0 &&  Auth()->user()->level !=  1)
                                Menunggu Petugas
                            @else
                            -- Pilih Disini --
                            @endif
                            </option>
                            @foreach ($petugas as $petugas)
                                <option {{ $trans->driver_id == $petugas->id ? 'selected' : ''}} value={{ $petugas->id }}>{{ $petugas->fullname }} - {{ $petugas->phone_number }}</option>
                            @endforeach
                          </select>   
                        </div>
                        <!--
                        @if($trans->driver_id >0)
                        <img src="{{ asset('upload/profile/'.$trans->photo) }}"  width="250px" height="auto" class="zoom">
                        @endif
                        -->
                      </div>

                  </div>
                  <div id="verifikasi" class="card-footer">
                    @if(Auth::user()->level == 1)
                     @if($trans->payment_status == 0)
                      <button type="submit" class="btn btn-info">Verifikasi</button>
                      @endif
                    @endif
                    @if(Auth::user()->level == 4)
                     @if($trans->trans_destination == 'Pengambilan Sendiri' && $trans->payment_status == 0)
                      <a href={{ url('trans/update_status_bayar/'. $trans->order_id) }}><button type="button" class="btn btn-success">Telah Dibayar</button>
                      @endif
                    @endif
                    @if(Auth::user()->level == 3)
                        @if($trans->trans_delivery == '1' && $trans->trans_sent == '0')
                            <a href={{ url('trans/update_status_kirim/'. $trans->order_id) }}>
                                    <button type="button" class="btn btn-success">Pesanan Diterima</button>
                            </a>
                        @elseif($trans->trans_sent == '1')
                                    <button type="button" class="btn btn-default">Pesanan Telah Diterima</button>
                        @endif
                    @endif
                    <a href="{{ route('trans')}}">
                        <button type="button" class="btn btn-warning float-right">Tutup</button>                
                    </a>
                  </div>
                </form>
        </div>
      </section>
  </div>
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Upload Bukti Pembayaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post" action="{{ route('trans.update_payment', $trans->order_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                  <input type="file" class="form-control" name="photo" id="photo" placeholder="Bukti Pembayaran" value="{{ $trans->payment_photo }}">
                    <p class="photo">{{ $trans->payment_photo }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script src="{{ asset( 'assets/js/jquery-1.9.1.js') }}"></script>
<script src="{{ asset( 'vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
function initMap() {
    var loc_lat = {{ $trans->loc_lat }};
    var loc_lng = {{ $trans->loc_lng }};
    var myLatLng = {lat: loc_lat, lng: loc_lng};
  
    var map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: 20,
    });
  
    var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Pergi ke Lokasi',
          draggable: false,
          url : 'https://www.google.com/maps/place/'+loc_lat+','+loc_lng
        });
  
     google.maps.event.addListener(marker, 'dragend', function(marker) {
        var latLng = marker.latLng;
        $('#address-latitude').val(latLng.lat());
        $('#address-longitude').val(latLng.lng());
     });

    google.maps.event.addListener(marker, 'click', function() {
      window.location.href = marker.url;
    });
}
  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUQaOBIQIBCIfWQb3r8-8Vv1-XWLH_aOk&callback=initMap&libraries=places&v=weekly" defer></script>
@endsection
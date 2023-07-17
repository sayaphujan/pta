@extends('layouts.adminlte.layout')
  
@section('content')

@php
  $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
  $orderId = substr(str_shuffle($permitted_chars), 0, 10);
  
@endphp

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
            <h1 class="m-0">Form Pesanan </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section>

      <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form method="POST" action="{{ route('pesan') }}" id="contactForm" name="contactForm" class="contactForm" enctype="multipart/form-data">
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
                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <p style="float:right">@php echo date('d-m-Y H:i:s'); @endphp</p>
                      </div>
                    </div>
                    <div class="row mt-3 mb-3">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Jenis Peruntukan</label>
                          <select name="category" class="form-control @error('category') is-invalid @enderror" id="category" aria-describedby="category" required="required">
                        <option value="">-- Pilih Disini --</option>
                        <option value="Niaga" {{ old('category') == 'Niaga' ? 'selected' : ''}}>Niaga</option>
                        <option value="Sosial" {{ old('category') == 'Sosial' ? 'selected' : ''}}>Sosial</option>
                        <option value="Pribadi Rumah Tangga" {{ old('category') == 'Pribadi Rumah Tangga' ? 'selected' : ''}}>Pribadi Rumah Tangga</option>
                      </select>    

                      @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Tujuan Pengiriman</label>
                          <select name="destination" class="form-control @error('destination') is-invalid @enderror" id="destination" aria-describedby="destination" required="required">
                        <option value="">-- Pilih Disini --</option>
                        <option data-id="1" value="Dalam Kota">Dalam Kota</option>
                        <!--<option data-id="2" value="Luar Kota">Luar Kota</option>-->
                        <option data-id="3" value="Pengambilan Sendiri">Pengambilan Sendiri</option>
                      </select> 

                      @error('destination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror   
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="hidden" class="form-control" name="price_id" id="price_id"readonly="readonly" value="{{ old('price_id') }}">
                          <label class="label" for="name">Volume Tangki</label>
                          <select name="volume" class="form-control @error('volume') is-invalid @enderror" id="volume" aria-describedby="volume" required="required">
                        <option value="">-- Pilih Disini --</option>
                        @foreach ($price as $price)
                          <option data-id={{ $price->price_id }} value={{ $price->price_volume }}>{{ number_format($price->price_volume,0) }}</option>
                        @endforeach
                      </select>

                      @error('volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror    
                        </div>
                      </div>
                    </div>
                
                    <div class="row mt-3 mb-3">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Harga Air</label>
                          <input type="text" class="form-control @error('net_price') is-invalid @enderror" name="net_price" id="net_price" placeholder="Harga Air" readonly="readonly" value="0" required="required">

                      @error('net_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Biaya Pengiriman</label>
                          <input type="text" class="form-control @error('deliv_price') is-invalid @enderror" name="deliv_price" id="deliv_price" placeholder="Biaya Pengiriman" readonly="readonly" value="0" required="required">

                      @error('deliv_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Total</label>
                          <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" id="total" placeholder="Total" readonly="readonly" value="0" required="required">

                      @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <input type="hidden" class="form-control" name="flag" id="flag" value="1">
                     <input type="hidden" class="form-control" name="order_id" id="order_id" placeholder="No. Pesanan" readonly="readonly" value="{{ $orderId }}">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="label" for="subject">Nama Pemohon</label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Pemohon" readonly="readonly" value="{{ strtoupper(Auth::user()->name) }}">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="subject">No. Telepon</label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="No. Telepon" required="required"  value="{{ Auth::user()->phone_number }}">

                      @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <label class="label" for="#">Alamat Pengiriman</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Alamat Pengiriman" required="required"  value="{{ strtoupper(Auth::user()->address) }}">

                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                      </div>
                    </div>

                    <div class="row mt-3 mb-3" style="display: none;">
                  <div class="col-md-6">
                    <label class="label" for="#">Latitude</label>
                    <input type="hidden" class="form-control" name="address_latitude" id="address-latitude" value="0" readonly="readonly" />
                  </div>

                  <div class="col-md-6">
                    <label class="label" for="#">Longitude</label>
                    <input type="text" class="form-control" name="address_longitude" id="address-longitude" value="0" readonly="readonly" />
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
                        <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="detail" cols="30" rows="4" placeholder="Detail Lokasi Pengiriman" value="{{ old('detail') }}">{{ old('fullname') }}</textarea>

                    @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                      </div>
                    </div>
<!--
                <div class="row mt-3 mb-3">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="label" for="#">Foto Lokasi</label>
                      <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" placeholder="Foto Lokasi" value="{{ old('photo') }}">
                      <p class="photo">{{ old('photo') }}</p>
                      @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                    </div>
                  </div>
                </div>
-->
                    <div class="row mt-3 mb-3">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="#">Keterangan Tambahan</label>
                          <input type="text" class="form-control @error('noted') is-invalid @enderror" name="noted" id="noted" placeholder="Keterangan Tambahan" value="{{ old('noted') }}">

                      @error('noted')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                        </div>
                       </div>
                    </div>

                    <div class="row mt-3 mb-3">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="label" for="name">Metode Pembayaran</label>
                         <select name="payment" class="form-control @error('payment') is-invalid @enderror" id="payment" aria-describedby="payment" required="required">
                        <option value="">-- Pilih Disini --</option>
                        <option value="Tunai"> Bayar di Tempat </option>
                        @foreach ($bank as $bank)
                          <option data-id={{ $bank->bank_id }} value={{ $bank->bank_id }}>{{ $bank->bank_name }}</option>
                        @endforeach
                      </select>

                      @error('volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror    
                        </div>
                      </div>
                    </div>

                  </div>
                  <div id="verifikasi" class="card-footer">
                      <button type="submit" class="btn btn-info">Kirim</button>
                  </div>
                </form>
            </div>
        </div>
      </section>
  </div>
  
<script src="{{ asset( 'assets/js/jquery-1.9.1.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
    window.onpageshow = function(event) {
      $('#volume').trigger("change");
      $('#destination').trigger("change");

      var net = parseInt($('#net_price').val());
      var deliv = parseInt($('#deliv_price').val());
      var sum = parseInt(net+deliv);
      $('#total').val(sum);
    };

  </script>
  <script type="text/javascript">
$(document).ready(function () {
  
    var txt = $("#phone");
    var func = function() {
        txt.val(txt.val().replace(/\s/g, ''));
    }
    txt.keyup(func).blur(func);

    var product = $('#volume').find(':selected').data('id'); 

    $('#destination').change(function(){
      var deliv = $('#destination').find(':selected').data('id'); 

        if(deliv == 1)
        {
          $('#deliv_price').val(0);
        }
        else if(deliv == 2)
        {
          $('#deliv_price').val(10000);
        }
        else if(deliv == 3)
        {
          $('#deliv_price').val(0);
        }
    })

    $('#volume').change(function(){
        var product = $(this).find(':selected').data('id');     
        $('#price_id').val(product);

        getPrice(product);
   });

    if( product >= 0){
        getPrice(product);
    }

    function getPrice(product){

        //alert(kecID);
        if(product){
            $.ajax({
               type:"GET",
               url:"{{ url('/getprice') }}/"+product,
               dataType: 'JSON',
               success:function(res){               
                console.log(res);
                
                var net = parseInt(res.price_net);
                var deliv = parseInt($('#deliv_price').val());
                var sum = parseInt(net+deliv);
                $('#total').val(sum);

                if(res){
                    $("#net_price").val(res.price_net);
                }else{
                   $("#net_price").val('0');
                }
               }
            });
        }else{
            $("#net_price").val('0');
        }    
    }

});
</script>
<script>
function initMap() {
    var myLatLng = {lat: -6.922237839463699, lng: 110.20010403863363};
  
    var map = new google.maps.Map(document.getElementById('map'), {
      center: myLatLng,
      zoom: 20
    });
  
    var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Pin Me!',
          draggable: true,
        });
  
     google.maps.event.addListener(marker, 'dragend', function(marker) {
        var latLng = marker.latLng;
        $('#address-latitude').val(latLng.lat());
        $('#address-longitude').val(latLng.lng());
     });
}
  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUQaOBIQIBCIfWQb3r8-8Vv1-XWLH_aOk&callback=initMap&libraries=places&v=weekly" defer></script>
  
@endsection
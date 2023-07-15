@extends('layouts.adminlte.layout')
  
@section('content')
<style type="text/css">
label {
    font-weight: 500!important;
}    

select[readonly] {
  background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
  pointer-events: none;
  touch-action: none;
} 
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Tambah Data Petugas Pengiriman') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section>
    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form method="post" action="{{ route('officers.store') }}" id="myForm" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                                    @error('fullname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DRV</span>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>
                                    <p class="username"></p> 
                                    @error('name')
                                        <span class="invalid-feedback username" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Password Konfirmasi') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <p class="email"></p> 
                                    @error('email')
                                        <span class="invalid-feedback email" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('No. Telepon') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" minlength="6" maxlength="13">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                 <label for="email" class="col-md-4 col-form-label">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Hak Akses') }}</label>
                        
                                <div class="col-md-6">
                                    <select name="level" class="form-control" id="level" aria-describedby="level" readonly>
                                        <option value="">-- Pilih Disini --</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Owner</option>
                                        <option value="3">User</option>
                                        <option value="4" selected>Driver</option>
                                    </select>    

                                     @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('officers')}}">
                            <button type="button" class="btn btn-default float-right">Batal</button>                           
                        </a>
                    </div>
                </form>
        </div>        
    </section>
</div>    
<script src="{{ asset( 'assets/js/jquery-1.9.1.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script type="text/javascript">

$(document).ready(function () {
    setTimeout(() => {
      //$('.alert').attr('style','display:none');
      $('.alert').hide(1000);
    }, 1000); // 👈️ time in milliseconds
    $.ajaxSetup({
              headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
             });

    var txt = $("#name");
    var func = function() {
        txt.val(txt.val().replace(/\s/g, ''));
    }
    txt.keyup(func).blur(func);

    var timer = null;
    $('#name').keyup(function() {
        clearTimeout(timer); 
        if($(this).val() != ''){
            timer = setTimeout(doStuff(this.id), 300)
        }
    });

    $('#email').keyup(function() {
        clearTimeout(timer); 
        if($(this).val() != ''){
            timer = setTimeout(doStuff(this.id), 300)
        }
    });

    function doStuff(id){
        var val = (id == 'name') ? 'DRV'+$("#"+id).val() : $("#"+id).val() ;
        var key = (id == 'name') ? 'username' : 'email';
         $.ajax({
                  url: "{{ route('exist') }}",
                  type: 'post',
                  data: { key : val, "_token": "{{ csrf_token() }}"},
                  success: function(response)
                  {
                    //console.log(response);

                    if(response > 0){
                        $("."+key).html('<span role="alert" style="color:red"><strong>'+key+' telah terdaftar</strong></span>');
                    }else{
                        $("."+key).html('<span role="alert" style="color:green"><strong>'+key+' tersedia</strong></span>');
                    }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");
                    }
                });
    }
});

            

</script>
@endsection
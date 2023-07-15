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
            <h1 class="m-0">{{ __('Tambah Data Harga') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section>
    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form method="post" action="{{ route('prices.store') }}" id="myForm" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Volume') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                    <input id="volume" type="text" class="form-control @error('volume') is-invalid @enderror" name="volume" value="{{ old('volume') }}" required autocomplete="volume" autofocus>
                                    <span class="input-group-text">Lt</span>
                                    </div>
                                    @error('price')
                                        <span class="invalid-feedback username" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Harga') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                    </div>
                                    @error('price')
                                        <span class="invalid-feedback username" role="alert">
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
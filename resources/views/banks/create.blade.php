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
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Tambah Data Rekening Bank') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section>
    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form method="post" action="{{ route('banks.store') }}" id="myForm" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Bank') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Pemilik') }}</label>

                                <div class="col-md-6">
                                    <input id="owner" type="text" class="form-control @error('owner') is-invalid @enderror" name="owner" value="{{ old('owner') }}" required autocomplete="owner" autofocus>

                                    @error('owner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('No. Rekening') }}</label>

                                <div class="col-md-6">
                                    <input id="no" type="text" class="form-control @error('no') is-invalid @enderror" name="no" value="{{ old('no') }}" required autocomplete="no">
                                    <p class="no"></p>

                                    @error('no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        <a href="{{ route('banks')}}">
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
    $('#no').keyup(function() {
        clearTimeout(timer); 
        if($(this).val() != ''){
            timer = setTimeout(doStuff(this.id), 300)
        }
    });

    function doStuff(id){
        var val = $("#"+id).val();
        var key = 'no';
         $.ajax({
                  url: "{{ route('find') }}",
                  type: 'post',
                  data: { key : val, "_token": "{{ csrf_token() }}"},
                  success: function(response)
                  {
                    //console.log(response);

                    if(response > 0){
                        $("."+key).html('<span role="alert" style="color:red"><strong>No Rekening Bank telah terdaftar</strong></span>');
                    }else{
                        $("."+key).html('<span role="alert" style="color:green"><strong>No Rekening Bank tersedia</strong></span>');
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
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Detail Rekening') }} &#64;{{ strtoupper($bank->bank_name) }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>

      <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form id="myForm" class="form-horizontal">
                  <div class="card-body">
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Bank') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $bank->bank_name }}" required autocomplete="name" autofocus readonly="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Pemilik') }}</label>

                                <div class="col-md-6">
                                    <input id="owner" type="text" class="form-control @error('owner') is-invalid @enderror" name="owner" value="{{ $bank->bank_own }}" required autocomplete="owner" autofocus readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('No. Rekening') }}</label>

                                <div class="col-md-6">
                                    <input id="no" type="text" class="form-control @error('no') is-invalid @enderror" name="no" value="{{ $bank->bank_num }}" required autocomplete="no" readonly>

                                </div>
                            </div>
                  </div>
                  <div class="card-footer">
                    <a href="{{ route('banks')}}">
                        <button type="button" class="btn btn-warning float-right">Kembali</button>                
                    </a>
                  </div>
                </form>
        </div>
      </section>
    </div>
  </div>
@endsection
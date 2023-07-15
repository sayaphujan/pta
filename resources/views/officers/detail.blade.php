@extends('layouts.adminlte.layout')
  
@section('content')
@php
    $officer->name = str_replace('DRV','',$officer->name);
@endphp

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
            <h1 class="m-0">{{ __('Detail Akun') }} &#64;{{ strtoupper($officer->name) }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>

      <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form id="myForm" class="form-horizontal">
                  <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="fullname" class="form-control" id="fullname" value="{{ $officer->fullname }}"aria-describedby="fullname" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Username') }}</label>                    
                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">DRV</span>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $officer->name }}" aria-describedby="name" readonly> </div>       
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ $officer->plain_password }}" readonly>
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>                    
                                <div class="col-md-6">
                                    <input type="text" name="email" class="form-control" id="email" value="{{ $officer->email }}" aria-describedby="email" readonly>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('No. Telepon') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $officer->phone_number }}" aria-describedby="phone_number" readonly>          
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Alamat') }}</label>                    
                                <div class="col-md-6">
                                    <textarea name="address" class="form-control" id="address" aria-describedby="address" required="required" value="{{ $officer->address }}" readonly>{{ $officer->address }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Hak Akses') }}</label>                   
                                <div class="col-md-6">
                                    <select name="level" class="form-control" id="level" aria-describedby="level" disabled readonlny>
                                        <option value="1" {{ $officer->level == '1' ? 'selected' : ''}}>Admin</option>
                                        <option value="2" {{ $officer->level == '2' ? 'selected' : ''}}>Owner</option>
                                        <option value="3" {{ $officer->level == '3' ? 'selected' : ''}}>User</option>
                                        <option value="4" {{ $officer->level == '4' ? 'selected' : ''}}>Driver</option>
                                    </select>    
                                </div>
                            </div>
                            
                  </div>
                  <div class="card-footer">
                    <a href="{{ route('officers')}}">
                        <button type="button" class="btn btn-warning float-right">Kembali</button>                
                    </a>
                  </div>
                </form>
        </div>
      </section>
    </div>
  </div>
@endsection
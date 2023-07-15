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
            <h1 class="m-0">{{ __('Detail Akun') }} &#64;{{ strtoupper($user->name) }}</h1>
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
                                    <input type="text" name="fullname" class="form-control" id="fullname" value="{{ $user->fullname }}"aria-describedby="fullname" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Username') }}</label>                    
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" aria-describedby="name" readonly>                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ $user->plain_password }}" readonly>
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>                    
                                <div class="col-md-6">
                                    <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}" aria-describedby="email" readonly>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('No. Telepon') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number }}" aria-describedby="phone_number" readonly>          
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Alamat') }}</label>                    
                                <div class="col-md-6">
                                    <textarea name="address" class="form-control" id="address" aria-describedby="address" required="required" value="{{ $user->address }}" readonly>{{ $user->address }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Hak Akses') }}</label>                   
                                <div class="col-md-6">
                                    <select name="level" class="form-control" id="level" aria-describedby="level" disabled readonlny>
                                        <option value="1" {{ $user->level == '1' ? 'selected' : ''}}>Admin</option>
                                        <option value="2" {{ $user->level == '2' ? 'selected' : ''}}>Owner</option>
                                        <option value="3" {{ $user->level == '3' ? 'selected' : ''}}>User</option>
                                        <option value="4" {{ $user->level == '4' ? 'selected' : ''}}>Petugas Pengiriman</option>
                                    </select>    
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Foto Profil</label>

                                <div class="col-md-6">
                                    <div class="image">
                                    @if(!empty($user->photo))
                                        <img class="zoom" src="{{ asset('upload/profile/'.$user->photo) }}"  width="250px" height="auto">
                                    @else
                                      <img src="{{ asset('assets/dist/img/user-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
                  </div>
                  <div class="card-footer">
                      @php
                            $url= '';
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segments = explode('/', $uri_path);
                                    
                            if(isset($uri_segments[1])){
                                        if($uri_segments[1] == 'profile'){
                                            $url = "profile";
                                        }else {
                                            $url = "users";
                                        }
                                    }
                        @endphp
                        @if($url == 'profile')
                    <a href="{{ url($url.'/edit/'.$user->id)}}">
                        <button type="button" class="btn btn-info">Sunting Profil</button>                
                    </a>
                 @endif
                    <a href="{{ route('users')}}">
                        <button type="button" class="btn btn-warning float-right">Kembali</button>                
                    </a>
                  </div>
                </form>
        </div>
      </section>
    </div>
  </div>
@endsection
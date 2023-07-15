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
            <h1 class="m-0">{{ __('Edit Data Pengguna') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </section>

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
                        
      <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header"></div>
                <form method="post" action="{{ route($url.'.update', $user->id) }}" id="myForm" class="form-horizontal" enctype="multipart/form-data">
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
                             <input type="hidden" name="url" class="form-control" id="url" value="{{ $url }}"aria-describedby="url" >
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="fullname" class="form-control" id="fullname" value="{{ $user->fullname }}"aria-describedby="fullname" >
                                    
                                
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
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" aria-describedby="name" >                
                                    <p class="username"></p>
                                    
                                    @error('name')
                                    <span class="invalid-feedback username" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password">
                                    <code>* Kosongkan jika tidak ingin mengganti password</code>
                                    <p class="password"></p>

                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('New Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter the new password">
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Confirm New Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter same password">

                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>                    
                                <div class="col-md-6">
                                    <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}" aria-describedby="email" >    
                                    <p class="email"></p> 
                                    
                                    @error('email')
                                    <span class="invalid-feedback email" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror            
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('No. Telepon') }}</label>
                                
                                <div class="col-md-6">
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number }}" aria-describedby="phone_number" >          
                                    
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror      
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Alamat') }}</label>                    
                                <div class="col-md-6">
                                    <textarea name="address" class="form-control" id="address" aria-describedby="address" required="required" value="{{ $user->address }}">{{ $user->address }}</textarea>
                                    
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Hak Akses') }}</label>                   
                                <div class="col-md-6">
                                    <select name="level" class="form-control" id="level" aria-describedby="level">
                                        <option value="1" {{ $user->level == '1' ? 'selected' : ''}}>Admin</option>
                                        <option value="2" {{ $user->level == '2' ? 'selected' : ''}}>Owner</option>
                                        <option value="3" {{ $user->level == '3' ? 'selected' : ''}}>User</option>
                                        <option value="4" {{ $user->level == '4' ? 'selected' : ''}}>Petugas Pengiriman</option>
                                    </select>    
                               
                                    @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Foto Profil</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="photo" id="photo" placeholder="Foto Profil" value="{{ $user->photo }}">
                                    <p class="photo">{{ $user->photo }}</p>
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
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="{{ route('users')}}">
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
      $('.alert').hide(1000);
    }, 1000);
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

    $('#current_password').keyup(function() {
        clearTimeout(timer); 
        if($(this).val() != ''){
            timer = setTimeout(doStuff(this.id), 300)
        }
    });

    function doStuff(id){
        var uid = '{{ $user->id }}';
        var val = $("#"+id).val();
        var key = (id == 'name') ? 'username' : (id == 'email') ? 'email' : 'password';
         $.ajax({
                  url: "{{ route('exist') }}",
                  type: 'post',
                  data: { key : val, "_token": "{{ csrf_token() }}"},
                  success: function(response)
                  {
                    //console.log(response);

                    if(response > 0){
                        if(key != 'password')
                        {
                            $("."+key).html('<span role="alert" style="color:red"><strong>'+key+' telah terdaftar</strong></span>');
                        }else{
                            $("."+key).html('');
                        }
                    }else{
                        if(key == 'password')
                        {
                            $("."+key).html('<span role="alert" style="color:red"><strong>'+key+' tidak sesuai</strong></span>');
                        }else{
                            $("."+key).html('<span role="alert" style="color:green"><strong>'+key+' tersedia</strong></span>');
                        }
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
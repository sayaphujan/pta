@extends('layouts.adminlte.layout')

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                <div class="card card-row card-primary mb-3" style="width: 70vw!important;">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body" style="padding: 0.75rem 1.25rem;">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>Selamat Datang <b>{{ ucfirst(Auth::user()->name) }}</b></p>
                        <p>Anda terdaftar sebagai @if (Auth::user()->level == 1)
                            <b>{{ 'ADMIN' }}</b>
                        @elseif (Auth::user()->level == 2)
                            <b>{{ 'OWNER' }}</b>
                        @elseif (Auth::user()->level == 3)
                            <b>{{ 'CUSTOMER' }}</b>
                         @elseif (Auth::user()->level == 4)
                            <b>{{ 'DRIVER' }}</b>
                        @endif</p>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection

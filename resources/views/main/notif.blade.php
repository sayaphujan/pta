@extends('layouts.chain.layout')

@section('content')
<style type="text/css">
    label {
        font-weight: 500;
        font-size: 15px;
        color: #2a2a2a;
    }
</style>
<div id="services" class="services section">
    <div class="container">
      <div class="row">
    <section>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                <h4>Pesanan<em> Diterima</em></h4>
                <img src="{{ asset('assets/images/heading-line-dec.png') }}" alt="">
                <p>Silakan masukkan no telepon ****-****-**** untuk melanjutkan proses pembayaran</p>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row mt-2 mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('No Telepon') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
    </section>
    </div>
  </div>
</div>
@endsection

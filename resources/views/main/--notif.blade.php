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
                <p></p>
              </div>
            </div>
          </div>
        </div>
      <div class="container" data-aos="fade-up">
	      <div class="row">
	          <div class="col-lg-12">
                    <form method="POST" action="{{ route('pay') }}" class="contactForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $trans->trans_id }}" id="id" name="id">
                        <input type="hidden" value="{{ $trans->order_id }}" id="order_id" name="order_id">
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="label" for="#">Foto Bukti Pembayaran</label>
                              <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo" placeholder="Foto Bukti Pembayaran" value="{{ old('photo') }}">
                              <p class="photo">{{ old('photo') }}</p>
                              @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                              @enderror
                            </div>
                          </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      </div>
    </section>
    </div>
  </div>
</div>
@endsection

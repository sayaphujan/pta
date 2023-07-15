@extends('layouts.adminlte.layout')

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
        
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($total_transaksi,0) }}</h3>
                                <p>Total Transaksi</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">{{ date('M Y') }}</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">  
                            <div class="inner">
                                <h3>{{ number_format($total_air_distribusi,0) }} <sup>m3</sup></h3>
                                <p>Air Terdistribusi (m3)</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                           <a href="#" class="small-box-footer">{{ date('M Y') }}</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($total_air_terjual,0) }}</h3>
                                <p>Air Terjual (Rp)</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">{{ date('M Y') }}</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ number_format($total_pembeli,0) }}</h3>
                                <p>Total Pembeli</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">{{ date('M Y') }}</a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Transaksi Hari ini, {{ date('d-m-Y') }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="progress-group">
                                    Belum Terbayar
                                    <span class="float-right">
                                        <b>{{ number_format($total_unpaid_today,0) }}</b>
                                        /
                                        {{ number_format($total_transaksi_today,0) }}
                                    </span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: {{ $percent_unpaid }}%"></div>
                                    </div>
                                </div>

                                <div class="progress-group">
                                    Terbayar
                                    <span class="float-right">
                                        <b>{{ number_format($total_paid_today,0) }}</b>
                                        /
                                        {{ number_format($total_transaksi_today,0) }}
                                    </span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: {{ $percent_paid }}%"></div>
                                    </div>
                                </div>

                                <div class="progress-group">
                                    <span class="progress-text">Belum Terkirim</span>
                                    <span class="float-right">
                                        <b>{{ number_format($total_unsent_today,0) }}</b>
                                        /
                                        {{ number_format($total_transaksi_today,0) }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" style="width: {{ $percent_unsent }}%"></div>
                                    </div>
                                </div>
                                
                                <div class="progress-group">
                                    Terkirim
                                    <span class="float-right">
                                        <b>{{ number_format($total_sent_today,0) }}</b>
                                        /
                                        {{ number_format($total_transaksi_today,0) }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: {{ $percent_sent }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                
            </div>
        </section>

<!--
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
      </section>-->
    </div>
  </div>
@endsection

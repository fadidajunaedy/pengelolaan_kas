@extends('layout.template')
@section('content')
<section class="is-hero-bar mb-4">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
      <h1 class="title text-lg">
        @if (Auth::guard('admins')->check())
            Selamat Datang, {{Auth::guard('admins')->user()->fullname}}
        @endif
        @if (Auth::guard('web')->check())
            Selamat Datang,{{Auth::guard('web')->user()->fullname}}
        @endif
      </h1>
    </div>
</section>

<div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Total Penerimaan
            </h3>
            <h2 class="text-2xl">
                @currency($totalJumlahPenerimaan)
            </h2>
          </div>
          <span class="icon widget-icon text-green-500"><i class="mdi mdi-cash mdi-48px"></i></span>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Total Pengeluaran
            </h3>
            <h2 class="text-2xl">
                @currency($totalJumlahPengeluaran)
            </h2>
          </div>
          <span class="icon widget-icon text-red-500"><i class="mdi mdi-cash-minus mdi-48px"></i></span>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-content">
        <div class="flex items-center justify-between">
          <div class="widget-label">
            <h3>
              Saldo
            </h3>
            <h2 class="text-2xl">
                @currency($totalJumlahSaldo)
            </h2>
          </div>
          <span class="icon widget-icon text-blue-500"><i class="mdi mdi-currency-usd mdi-48px"></i></span>
        </div>
      </div>
    </div>
</div>
@endsection
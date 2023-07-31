@extends('layout.template')
@section('content')
<style>
  .image {
    border-radius: 50%;
    overflow: hidden;
  }

  .image img {
    width: 100%;
    height: 100%;
    object-fit: cover
  }
</style>
<nav class="w-full rounded-md flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0 mb-4">
    <ol class="list-reset flex">
        <li>
        <a
            href="{{ url('/')}}"
            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >Dashboard</a
        >
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">Laporan</li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">Laporan Pengeluaran</li>
    </ol>
</nav>
@include('components.notification')
<div class="card-content">
          <form id="form-get-by-tanggal" action="{{ url('/pengeluaran-pertanggal-preview') }}" method="get">
            @csrf
            <div class="field flex items-center gap-2">
                <label class="label basis-1/4">Per Tanggal</label>
                <select name="tanggal" class="input basis-2/4">
                    <option selected disabled>-- Pilih Tanggal --</option>
                    @php($tanggal = [])
                    @foreach ($tanggalPengeluaran as $item)
                    @php($tgl = \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d'))
                    @if (!in_array($tgl, $tanggal))
                      <option class="input" name="tanggal" value="{{ $tgl }}">
                        {{ \Carbon\Carbon::parse($tgl)->translatedFormat('l, d F Y') }}
                      </option>
                      @php($tanggal[] = $tgl)
                    @endif
                    @endforeach
                </select>
                <button type="submit" class="button blue">Cek Laporan</button>
            </div>
        </form>
        <hr>
        <form id="form-get-by-bulan" action="{{ url('/pengeluaran-perbulan-preview') }}" method="get">
            @csrf
            <div class="field flex items-center gap-2">
                <label class="label basis-1/4">Per Bulan</label>
                <select name="bulan" class="input basis-1/4">
                    <option selected disabled>-- Pilih Bulan --</option>
                    @php($bulan = [])
                    @foreach ($tanggalPengeluaran as $item)
                    @php($bln = \Carbon\Carbon::parse($item->tanggal)->format('F'))
                    @if (!in_array($bln, $bulan))
                      <option class="input" name="bulan" value="{{ $bln }}">
                        {{ \Carbon\Carbon::parse($bln)->translatedFormat('F') }}
                      </option>
                      @php($bulan[] = $bln)
                    @endif
                    @endforeach
                </select>
                <select name="tahun" class="input basis-1/4" style="width: 200px;">
                  <option name="tahun" class="input" disabled selected>
                  -- Pilih Tahun --
                  </option>
                  @php($th = [])
                  @foreach ($tanggalPengeluaran as $item)
                  @php($i = \Carbon\Carbon::parse($item->tanggal)->Format('Y'))
                  @if (!in_array($i, $th))
                    <option class="input" name="tahun" value="{{ $i }}">
                      {{ $i }}
                    </option>
                    @php($th[] = $i)
                  @endif
                  @endforeach
                </select>
                <button type="submit" class="button blue">Cek Laporan</button>
            </div>
      </form>
        <hr>
        <form id="form-get-by-tahun" action="{{ url('/pengeluaran-pertahun-preview') }}" method="get">
            @csrf
            <div class="field flex items-center gap-2">
                <label class="label basis-1/4">Per Tahun</label>
                <select name="tahun" class="input basis-2/4" style="width: 200px;">
                    <option name="tahun" class="input" disabled selected>
                    -- Pilih Tahun --
                    </option>
                    @php($tahun = [])
                    @foreach ($tanggalPengeluaran as $item)
                    @php($thn = \Carbon\Carbon::parse($item->tanggal)->Format('Y'))
                    @if (!in_array($thn, $tahun))
                      <option class="input" name="tahun" value="{{ $thn }}">
                        {{ $thn }}
                      </option>
                      @php($tahun[] = $thn)
                    @endif
                    @endforeach
                  </select>
                  <button type="submit" class="button blue">Cek Laporan</button>
            </div>
        </form>
</div>
@endsection
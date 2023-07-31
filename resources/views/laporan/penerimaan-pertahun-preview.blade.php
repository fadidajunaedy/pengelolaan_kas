@extends('layout.template')
@section('content')
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
        <li>
            <a
            href="{{ url('/laporan-penerimaan')}}"
            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >Laporan Penerimaan</a>
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">{{ \Carbon\Carbon::parse($data[0]->tanggal)->translatedFormat('Y') }}</li>
    </ol>
  <form action="{{ url('/generate-penerimaan-pertahun') }}" method="get">
    @csrf
    @php($thn = \Carbon\Carbon::parse($data[0]->tanggal)->Format('Y'))
    <input type="hidden" name="tahun" value="{{ $thn }}">
    <button type="submit" class="button green">Download &nbsp;<span class="mdi mdi-download"></span></button>
  </form>
</nav>
@include('components.notification')

<div class="card has-table">
    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-cash"></i></span>
            Penerimaan Kas tahun {{ \Carbon\Carbon::parse($data[0]->tanggal)->translatedFormat('Y') }}
        </p>
    </header>
    <div class="card-content mb-6">
      <table>
        <thead>
        <tr>
          <th>No</th>
          <th>No Kwitansi</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Jumlah</th>
        </tr>
        </thead>
        <tbody>
          <?php $i = $data->firstItem() ?>
          @php ($jumlah = 0)
          @foreach ($data as $item)
          <tr>
            <td>{{ $i }}</td>
            <td data-label="Nomor Kwitansi">{{ $item->no_kwitansi }}</td>
            <td data-label="Nama">{{ $item->nama }}</td>
            <td data-label="Tanggal">
                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
            </td>
            <td data-label="Keterangan">{{ $item->keterangan }}</td>
            <td data-label="Jumlah" id="jumlahKas">
                @currency($item->jumlah)
            </td>
          </tr>
          <?php $i++ ?>
          @php ($jumlah += $item->jumlah)
          @endforeach
          <tr>
            <td class="text-center font-bold" colspan="5">Total</td>
            <td>@currency($jumlah)</td>
          </tr>
        </tbody>
      </table>
      {{ $data->withQueryString()->links() }}
    </div>

    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-cash"></i></span>
            Anggota yang belum bayar pada Tahun {{ \Carbon\Carbon::parse($data[0]->tanggal)->translatedFormat('Y') }}
        </p>
    </header>
    <div class="card-content">
      <table>
        <thead>
        <tr>
          <th>No</th>
          <th>Nomor Anggota</th>
          <th>Nama</th>
          <th>Nomor Telepon</th>
          <th>Alamat</th>
        </tr>
        </thead>
        <tbody>
          <?php $i = $data->firstItem() ?>
          @foreach ($anggotaBelumBayar as $item)
          <tr>
            <td>{{ $i }}</td>
            <td data-label="Nomor Anggota">{{ $item->no_anggota }}</td>
            <td data-label="Nama">{{ $item->nama }}</td>
            <td data-label="Nomor Telepon">{{ $item->no_telepon }}</td>
            <td data-label="Alamat">{{ $item->alamat }}</td>
          </tr>
          <?php $i++ ?>
          @endforeach
          @if ($anggotaBelumBayar->isEmpty())
          <tr>
            <td colspan="5" class="text-center ext-neutral-500 dark:text-neutral-400">Tidak ada Data</td>
          </tr>
          @endif
        </tbody>
      </table>
      {{ $data->withQueryString()->links() }}
    </div>
</div>
@endsection
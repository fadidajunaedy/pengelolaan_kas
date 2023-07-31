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
            href="{{ url('/laporan-rekapitulasi')}}"
            class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >Rekapitulasi</a
        >
        </li>
        <li>
            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
        </li>
        <li class="text-neutral-500 dark:text-neutral-400">{{ \Carbon\Carbon::parse($dataPenerimaan[0]->tanggal)->translatedFormat('Y') }}</li>
    </ol>
  <form action="{{ url('/generate-rekapitulasi-pertahun') }}" method="get">
    @csrf
    @php($th = \Carbon\Carbon::parse($dataPenerimaan[0]->tanggal)->Format('Y'))
    <input type="hidden" name="tahun" value="{{ $th }}">
    <button type="submit" class="button green">Download &nbsp;<span class="mdi mdi-download"></span></button>
  </form>
</nav>
@include('components.notification')

<div class="card has-table">
    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-cash"></i></span>
            Penerimaan Kas tahun {{ \Carbon\Carbon::parse($dataPenerimaan[0]->tanggal)->translatedFormat('Y') }}
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
          <?php $i = $dataPenerimaan->firstItem() ?>
          @php ($jumlah = 0)
          @foreach ($dataPenerimaan as $item)
          <tr>
            <td>{{ $i }}</td>
            <td data-label="Nomor Kwitansi">{{ $item->no_kwitansi }}</td>
            <td data-label="Nama">{{ $item->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
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
      {{ $dataPenerimaan->withQueryString()->links() }}
    </div>

    <header class="card-header">
      <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-cash"></i></span>
          Pengeluaran Kas tahun {{ \Carbon\Carbon::parse($dataPengeluaran[0]->tanggal)->translatedFormat('Y') }}
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
        <?php $i = $dataPengeluaran->firstItem() ?>
        @php ($jumlah = 0)
        @foreach ($dataPengeluaran as $item)
        <tr>
          <td>{{ $i }}</td>
          <td data-label="Nomor Kwitansi">{{ $item->no_kwitansi }}</td>
          <td data-label="Nama">{{ $item->nama }}</td>
          <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
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
    {{ $dataPengeluaran->withQueryString()->links() }}
  </div>

    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-cash"></i></span>
            Anggota yang belum bayar pada tahun {{ \Carbon\Carbon::parse($dataPenerimaan[0]->tanggal)->translatedFormat('Y') }}
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
          <?php $i = $anggotaBelumBayar->firstItem() ?>
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
      {{ $anggotaBelumBayar->withQueryString()->links() }}
    </div>

    <header class="card-header">
      <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-cash"></i></span>
          Anggota yang belum melakukan pengeluaran pada tahun {{ \Carbon\Carbon::parse($dataPengeluaran[0]->tanggal)->translatedFormat('Y') }}
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
        <?php $i = $anggotaBelumMelakukanPengeluaran->firstItem() ?>
        @foreach ($anggotaBelumMelakukanPengeluaran as $item)
        <tr>
          <td>{{ $i }}</td>
          <td data-label="Nomor Anggota">{{ $item->no_anggota }}</td>
          <td data-label="Nama">{{ $item->nama }}</td>
          <td data-label="Nomor Telepon">{{ $item->no_telepon }}</td>
          <td data-label="Alamat">{{ $item->alamat }}</td>
        </tr>
        <?php $i++ ?>
        @endforeach
        @if ($anggotaBelumMelakukanPengeluaran->isEmpty())
            <tr>
              <td colspan="5" class="text-center ext-neutral-500 dark:text-neutral-400">Tidak ada Data</td>
            </tr>
        @endif
      </tbody>
    </table>
    {{ $anggotaBelumMelakukanPengeluaran->withQueryString()->links() }}
  </div>

    
</div>
@endsection
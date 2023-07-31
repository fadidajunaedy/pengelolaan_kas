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
    <li class="text-neutral-500 dark:text-neutral-400">Penerimaan</li>
  </ol>
  <a href="{{ url('penerimaan/create')}}" class="button medium blue flex justify-center items-center">
    <span class="icon"><i class="mdi mdi-plus-box"></i></span>Tambah Data
  </a>
</nav>
@include('components.notification')

<div class="card has-table">
    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-cash"></i></span>
            Penerimaan Kas
        </p>
        <form action="{{ url('penerimaan/') }}" method="get" class="card-header-title">
            @csrf
            <input type="text" class="input mr-2 font-normal" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Masukkan kata kunci">
            <button type="submit" class="button medium blue">Cari</button>
        </form>
    </header>
    <div class="card-content">
      <table>
        <thead>
        <tr>
          <th>No</th>
          <th>No Kwitansi</th>
          <th>Nama</th>
          <th>Hari/Tanggal</th>
          <th>Keterangan</th>
          <th>Jumlah</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          <?php $i = $data->firstItem() ?>
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
            <td class="actions-cell">
              <div class="buttons right nowrap">
                <a href="{{ url('penerimaan/'.$item->no_kwitansi.'/'.'edit/')}}" class="button small blue" type="button">
                  <span class="icon"><i class="mdi mdi-file-edit"></i></span>
                </a>
                <button class="button small red --jb-modal" data-target="modal{{ $i }}" type="button">
                  <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                </button>
              </div>

              {{-- MODAL CONFIRM --}}
              <div id="modal{{ $i }}" class="modal">
                <div class="modal-background --jb-modal-close"></div>
                <div class="modal-card">
                  <header class="modal-card-head">
                    <p class="modal-card-title">Perhatian!</p>
                  </header>
                  <section class="modal-card-body">
                    <p>Apakah yakin ingin menghapus Kwitansi <b>{{ $item->no_kwitansi }}</b></p>
                  </section>
                  <footer class="modal-card-foot">
                    <button class="button --jb-modal-close">Kembali</button>
                    <form class="d-inline" action="{{ url('penerimaan/'.$item->no_kwitansi)}}" method="post">
                      @csrf 
                      @method('DELETE') 
                      <button type="submit" class="button red">Hapus</button>
                    </form>
                  </footer>
                </div>
              </div>
            </td>
          </tr>
          <?php $i++ ?>
          @endforeach
        </tbody>
      </table>
      {{ $data->withQueryString()->links() }}
    </div>
  </div>
@endsection
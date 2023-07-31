@extends('layout.template')
@section('content')
<style>
  .foto {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    overflow: hidden;
  }

  .foto img {
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
    <li class="text-neutral-500 dark:text-neutral-400">Manajemen User</li>
  </ol>
  <a href="{{ url('users/create')}}" class="button medium blue flex justify-center items-center">
    <span class="icon"><i class="mdi mdi-plus-box"></i></span>Tambah Data
  </a>
</nav>
@include('components.notification')

<div class="card has-table">
    <header class="card-header">
        <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-group"></i></span>
            Manajemen User
        </p>
        <form action="{{ url('users/') }}" method="get" class="card-header-title">
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
          <th>Foto</th>
          <th>Username</th>
          <th>Nama Lengkap</th>
          <th>Status</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          <?php $i = $data->firstItem() ?>
          @foreach ($data as $item)
          <tr>
            <td>{{ $i }}</td>
            <td data-label="Foto">
              <div class="foto">
                @if ($item->foto)
                <img src="{{ url('foto'.'/'.$item->foto)}}" alt="Foto User">          
                @else
                <img src="{{ url('images/user-default.png')}}" alt="Foto User">
                @endif
              </div>
            </td>
            <td data-label="Username">
              {{ $item->username }}
            </td>
            <td data-label="Nama Lengkap">
              {{ $item->fullname }}
            </td>
            <td data-label="Foto">
              {{ $item->status }}
            </td>
            <td class="actions-cell">
              <div class="buttons right nowrap">
                @if ($item->status == 'aktif')
                  <form class="d-inline" action="{{ url('users/'.$item->id.'/'.'change-to-non-aktif/')}}" method="post">
                    @csrf 
                    @method('PUT')
                    <button class="button small bg-yellow-400" type="submit" class="button red">
                      <span class="icon"><i class="mdi mdi-power"></i></span>
                    </button>
                  </form>
                @else
                  <form class="d-inline" action="{{ url('users/'.$item->id.'/'.'change-to-aktif/')}}" method="post">
                    @csrf 
                    @method('PUT')
                    <button class="button small bg-yellow-400" type="submit" class="button red">
                      <span class="icon"><i class="mdi mdi-check"></i></span>
                    </button>
                  </form>
                @endif
                <a href="{{ url('users/'.$item->id.'/'.'edit/')}}" class="button small blue" type="button">
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
                    <p>Apakah yakin ingin menghapus User <b>{{ $item->username }}</b></p>
                  </section>
                  <footer class="modal-card-foot">
                    <button class="button --jb-modal-close">Kembali</button>
                    <form class="d-inline" action="{{ url('users/'.$item->id)}}" method="post">
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
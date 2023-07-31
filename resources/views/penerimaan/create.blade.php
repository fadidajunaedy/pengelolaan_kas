@extends('layout.template')
@section('content')
<nav class="w-full rounded-md">
  <ol class="list-reset flex">
    <li>
      <a
        href="{{ url('/') }}"
        class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
        >Dashboard</a
      >
    </li>
    <li>
      <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
    </li>
    <li>
      <a
        href="{{ url('/penerimaan') }}"
        class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
        >Penerimaan</a
      >
    </li>
    <li>
      <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
    </li>
    <li class="text-neutral-500 dark:text-neutral-400">Tambah Data</li>
  </ol>
</nav>
<div class="card-content">
  @include('components.notification')
    <form action="{{ url('/penerimaan') }}" method="POST">
      @csrf
        <div class="field">
            <label class="label">No Kwitansi</label>
            <input class="input" name="no_kwitansi" type="text" required>
        </div>
        <div class="field">
          <label class="label">Nama</label>
          <select name="nama" class="input basis-2/4">
            <option selected disabled>-- Pilih Anggota --</option>
            @foreach ($anggota as $a)
              <option class="input" name="nama" value="{{ $a->nama }}">
                {{ $a->nama }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="field">
            <label class="label">Tanggal</label>
            <input class="input" name="tanggal" type="date" required>
        </div>
        <div class="field">
            <label class="label">Keterangan</label>
            <textarea name="keterangan" class="input h-40" cols="30" rows="10" required></textarea>
        </div>
        <div class="field">
            <label class="label">Jumlah</label>
            <input class="input" id="jumlah" name="jumlah" type="text" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
        </div>
        <div class="field grouped">
            <div class="control">
              <button type="submit" class="button green">
                Submit
              </button>
            </div>
            <div class="control">
              <button type="reset" class="button red">
                Reset
              </button>
            </div>
        </div>
    </form>
</div>
@endsection

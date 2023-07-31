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
        href="{{ url('/anggota') }}"
        class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
        >Anggota</a
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
    <form action="{{ url('/anggota') }}" method="POST">
      @csrf
        <div class="field">
            <label class="label">No Anggota</label>
            <input class="input" name="no_anggota" type="text" required>
        </div>
        <div class="field">
            <label class="label">Nama</label>
            <input class="input" name="nama" type="text" required>
        </div>
        <div class="field">
            <label class="label">Nomor Telepon</label>
            <input class="input" name="no_telepon" type="text" required>
        </div>
        <div class="field">
            <label class="label">Alamat</label>
            <textarea name="alamat" class="input h-40" cols="30" rows="10" required></textarea>
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

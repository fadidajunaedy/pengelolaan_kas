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
      <li class="text-neutral-500 dark:text-neutral-400">{{ $data->no_anggota }}</li>
    </ol>
</nav>
<div class="card-content">
    <form action="{{ url('anggota/'.$data->no_anggota) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="field">
            <label class="label">Nomor Anggota</label>
            <input class="input" name="no_anggota" type="text" value="{{ $data->no_anggota }}" disabled>
        </div>
        <div class="field">
          <label class="label">Nama</label>
          <input class="input" name="nama" type="text" value="{{ $data->nama }}" required>
        </div>
        <div class="field">
          <label class="label">Nomor Telepon</label>
          <input class="input" name="no_telepon" type="text" value="{{ $data->no_telepon }}" required>
        </div>
        <div class="field">
            <label class="label">Alamat</label>
            <textarea name="alamat" class="input h-40" cols="30" rows="10">{{ $data->alamat }}</textarea>
        </div>
        <div class="field grouped">
            <div class="control">
            <button type="submit" class="button green">
                Submit
            </button>
            </div>
        </div>
    </form>
</div>
@endsection

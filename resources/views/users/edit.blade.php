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
          href="{{ url('/users') }}"
          class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
          >Manajemen Users</a
        >
      </li>
      <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
      </li>
      <li class="text-neutral-500 dark:text-neutral-400">{{ $data->username }}</li>
    </ol>
</nav>
<div class="card-content">
    <form action="{{ url('users/'.$data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="field">
            <label class="label">Username</label>
            <input class="input" name="username" type="text" value="{{ $data->username }}">
        </div>
        <div class="field">
            <label class="label">Password</label>
            <input class="input" name="password" type="password" placeholder="Kosongkan password jika tidak diubah">
        </div>
        <div class="field">
            <label class="label">Nama Lengkap</label>
            <input class="input" name="fullname" type="text" value="{{ $data->fullname }}">
        </div>
        <div class="field">
            <label class="label">Email</label>
            <input class="input" name="email" type="email" value="{{ $data->email }}">
        </div>
        <div class="field">
            <label class="label">Telepon</label>
            <input class="input" name="telepon" type="text" value="{{ $data->telepon }}">
        </div>
        <div class="field">
          <label class="label">Foto</label>
          <div class="field-body mb-2">
            <div class="field file">
              <label class="upload control">
                <a class="button blue">
                  Upload Foto
                </a>
                <input type="file" id="image" name="foto" accept="image/png, image/jpeg"> 
              </label>
            </div>
          </div>
          @if ($data->foto)
            <img id="preview-image-before-upload" src="{{ url('foto').'/'.$data->foto }}" style="max-height: 250px;">              
          @else
            <img id="preview-image-before-upload" src="{{ url('images/user-default.png') }}" style="max-height: 250px;">
          @endif
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

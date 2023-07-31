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
    <li class="text-neutral-500 dark:text-neutral-400">Profile User</li>
  </ol>
</nav>
@include('components.notification')
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-circle"></i></span>
            Edit Profile
          </p>
        </header>
        <div class="card-content">
          <form action="{{ url('profile/'.$data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="field">
              <label class="label">Foto</label>
              <div class="field-body">
                <div class="field file">
                  <label class="upload control">
                    <a class="button blue">
                      Upload Foto
                    </a>
                    <input id="image" type="file" name="foto">
                  </label>
                </div>
              </div>
            </div>
            <hr>
            <div class="field">
              <label class="label">Username</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" autocomplete="on" name="username" value="{{ $data->username }}" class="input" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="field">
              <label class="label">Nama Lengkap</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" autocomplete="on" name="fullname" value="{{ $data->fullname }}" class="input" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="field">
              <label class="label">E-mail</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="email" autocomplete="on" name="email" value="{{ $data->email }}" class="input">
                  </div>
                </div>
              </div>
            </div>
            <div class="field">
                <label class="label">No Telepon</label>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="text" autocomplete="on" name="telepon" value="{{ $data->telepon }}" class="input">
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            <div class="field">
              <div class="control">
                <button type="submit" class="button green">
                  Save
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account"></i></span>
            Profile
          </p>
        </header>
        <div class="card-content">
            <div class="image w-48 h-48 mx-auto">
              @if ($data->foto)
              <img src="{{ url('foto'.'/'.$data->foto)}}" id="preview-image-before-upload" alt="Foto User">          
              @else
                <img src="{{ url('images/user-default.png')}}" id="preview-image-before-upload" alt="Foto User">
              @endif
            </div>
            <hr>
            <div class="field">
                <label class="label">Username</label>
                <div class="control">
                <input type="text" readonly value="{{ $data->username }}" class="input is-static">
                </div>
            </div>
            <div class="field">
                <label class="label">Nama Lengkap</label>
                <div class="control">
                <input type="text" readonly value="{{ $data->fullname }}" class="input is-static">
                </div>
            </div>
            <hr>
            <div class="field">
                <label class="label">E-mail</label>
                <div class="control">
                <input type="text" readonly value="{{ $data->email }}" class="input is-static">
                </div>
            </div>
            <div class="field">
                <label class="label">Telepon</label>
                <div class="control">
                <input type="text" readonly value="{{ $data->telepon }}" class="input is-static">
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
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
    <li class="text-neutral-500 dark:text-neutral-400">Tambah Data</li>
  </ol>
</nav>
<div class="card-content">
  @include('components.notification')

    <form action="{{ url('/users') }}" method="POST">
      @csrf
        <div class="field">
            <label class="label">Username</label>
            <input class="input" name="username" type="text" required>
        </div>
        <div class="field">
            <label class="label">Nama Lengkap</label>
            <input class="input" name="fullname" type="text" required>
        </div>
        <div class="field">
            <label class="label">Password</label>
            <input class="input" name="password" type="password" required>
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

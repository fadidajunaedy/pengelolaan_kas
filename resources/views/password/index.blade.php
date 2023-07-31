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
    <li class="text-neutral-500 dark:text-neutral-400">Ubah Password</li>
  </ol>
</nav>
<div class="card-content">
  @include('components.notification')
    <form action="{{ url('password/change-password') }}" method="POST">
      @csrf
      @method('PUT')
        <div class="field">
            <label class="label">Password Lama</label>
            <input class="input" name="old_password" type="password" required>
        </div>
        <div class="field">
            <label class="label">Password Baru</label>
            <input class="input" name="new_password" type="password" required>
        </div>
        <div class="field">
            <label class="label">Ulang Password Baru (Konfirmasi Password)</label>
            <input class="input" name="new_password_confirmation" type="password" required>
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

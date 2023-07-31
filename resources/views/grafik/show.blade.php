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
    <li class="text-neutral-500 dark:text-neutral-400">Grafik</li>
  </ol>
  {{-- <a href="{{ url('users/create')}}" class="button medium blue flex justify-center items-center">
    <span class="icon"><i class="mdi mdi-plus-box"></i></span>Tambah Data
  </a> --}}
</nav>
@include('components.notification')

{!! $KasChart->container() !!}
<script src="{{ $KasChart->cdn() }}"></script>

{{ $KasChart->script() }}

@endsection
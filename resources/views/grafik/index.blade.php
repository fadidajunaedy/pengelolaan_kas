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
  <form action="{{ url('grafik/') }}" class="flex justify-center items-center gap-2">
    @csrf
    <label class="font-bold">Tahun</label>
    <select class="input" name="tahun" style="width: 200px;">
      <option class="input" disabled selected>
      -- Pilih Tahun --
      </option>
      @php($header = [])
      @foreach ($tahunPenerimaan as $item)
      @php($i = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('Y'))
      @if (!in_array($i, $header))
        <option class="input" name="tahun" value="{{ $i }}">
          {{ $i }}
        </option>
        @php($header[] = $i)
      @endif
      @endforeach
      @foreach ($tahunPengeluaran as $item)
      @php($i = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('Y'))
      @if (!in_array($i, $header))
        <option class="input" name="tahun" value="{{ $i }}">
          {{ $i }}
        </option>
        @php($header[] = $i)
      @endif
      @endforeach
    </select>
    <button class="button blue" type="submit">Generate</button>
  </form>
  {{-- <a href="{{ url('users/create')}}" class="button medium blue flex justify-center items-center">
    <span class="icon"><i class="mdi mdi-plus-box"></i></span>Tambah Data
  </a> --}}
</nav>
@include('components.notification')
{!! $KasChart->container() !!}
<script src="{{ $KasChart->cdn() }}"></script>

{{ $KasChart->script() }}
@endsection
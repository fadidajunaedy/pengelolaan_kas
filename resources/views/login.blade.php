<!DOCTYPE html>
<html lang="en" class="form-screen">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Admin One Tailwind CSS Admin Dashboard</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="{{ asset('css/main.css')}}">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="Admin One - free Tailwind dashboard">

  <meta property="og:url" content="https://justboil.github.io/admin-one-tailwind/">
  <meta property="og:site_name" content="JustBoil.me">
  <meta property="og:title" content="Admin One HTML">
  <meta property="og:description" content="Admin One - free Tailwind dashboard">
  <meta property="og:image" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="960">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Admin One HTML">
  <meta property="twitter:description" content="Admin One - free Tailwind dashboard">
  <meta property="twitter:image:src" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="twitter:image:width" content="1920">
  <meta property="twitter:image:height" content="960">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-130795909-1');
  </script>
  <style>
    #app {
      padding: 48px 0;
    }
  </style>
</head>
<body>

<div id="app">
  <section class="section main-section flex flex-col justify-center items-center">
     <img src="{{ asset('images/koperasi.png')}}" alt="Logo Koperasi" style="height: 100px; margin-bottom: 24px;"> 
    <h1 class="text-4xl font-bold">KAS KOPERASI</h1>
    <h1 class="text-4xl font-bold">MAJU BERSAMA SEBELAS</h1>
    <div class="card mt-4">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-lock"></i></span>
          Silahkan Login!
        </p>
      </header>
      <div class="card-content">
        @include('components.notification')
        <form action="{{ url('/login')}}" method="post">
            @csrf
            <div class="field spaced">
                <label class="label">Username</label>
                <div class="control icons-left">
                <input class="input" type="text" name="username">
                <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                </div>
                <p class="help">
                    Masukkan username anda
                </p>
            </div>

            <div class="field spaced">
                <label class="label">Password</label>
                <p class="control icons-left">
                <input class="input" type="password" name="password">
                <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                </p>
                <p class="help">
                    Masukkan Password anda
                </p>
            </div>

            <hr>

            <div class="field grouped">
                <div class="control w-full">
                <button type="submit" class="button blue w-full">
                    Login
                </button>
                </div>
            </div>
        </form>
      </div>
    </div>

  </section>
</div>

<script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>

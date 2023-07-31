<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KOPERASI MAJU BERSAMA SEBELAS</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="{{ asset('css/main.css')}}">
  @vite('resources/css/app.css')

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/koperasi.png')}}"/>
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/koperasi.png')}}"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="Admin One - free Tailwind dashboard">

  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
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
  <style>
    .main-section {
      min-height: 85vh !important;
    }
  </style>
</head>
<body>
<div id="app">
  @include('layout.partials.header')
  @include('layout.partials.nav')
  <section class="section main-section">
    @yield('content')
  </section>
</div>
@include('layout.partials.footer')

<!-- Scripts below are for demo only -->
{{-- <script type="text/javascript" src="{{ asset('js/main.min.js?v=1628755089081')}}"></script> --}}
<script type="text/javascript" src="{{ asset('js/main.js')}}"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/jquery.maskMoney.min.js')}}"></script>
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
<script type="text/javascript" language="javascript">
  //Code Preview Image
  $(document).ready(function (e) {
     $('#image').change(function(){
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('#preview-image-before-upload').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]); 
     }); 
  });

  function getkey(e) {
    if (window.event)
      return window.event.keyCode;
    else if (e)
      return e.which;
    else
      return null;
  }

  function goodchars(e, goods, field) {
    let key, keychar;
    key = getkey(e);
    if (key == null) return true;
      keychar = String.fromCharCode(key);
      keychar = keychar.toLowerCase();
      goods = goods.toLowerCase();
     
      // check goodkeys
      if (goods.indexOf(keychar) != -1)
        return true;
      // control keys
      if ( key==null || key==0 || key==8 || key==9 || key==27 )
        return true;    
      if (key == 13) {
        let i;
        for (i = 0; i < field.form.elements.length; i++)
          if (field == field.form.elements[i])
          break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
      };
    // else return false
    return false;
  }
  // mask money
  $('#jumlah').maskMoney({thousands:'.', decimal:',', precision:0});
  $('#jumlahKas').maskMoney({thousands:'.', decimal:',', precision:0});
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Template Surat Pelaporan Kas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.5;
      color: #1F2937;
      font-size: 0.75rem;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .subject {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    .address {
      margin-bottom: 20px;
    }
    
    .content {
      margin-bottom: 20px;
    }
    
    .closing {
      text-align: right;
      margin-top: 50px;
    }
    
    .signature {
      margin-top: 20px;
      text-align: center;
    }

    table.blueTable {
  border: 0px solid #1C6EA4;
  background-color: #F9FAFB;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 10px 5px;
}
table.blueTable tbody td {
  /* font-size: 13px; */
}
table.blueTable tr:nth-child(even) {
  background: #FFFFFF;
}
table.blueTable thead {
  background: #1F2937;
  border-bottom: 0px solid #444444;
}
table.blueTable thead th {
  /* font-size: 15px; */
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 0px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot td {
  /* font-size: 14px; */
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}

.td-totalJumlah {
    text-align: center;
    color: #1F2937;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>KOPERASI MAJU BERSAMA SEBELAS</h1>
      <h2 style="line-height: 3px; margin-bottom: 24px;">PELAPORAN PENGELUARAN KAS</h2>
    </div>
    <div class="content">
      <p>Berikut ini adalah laporan pengeluaran kas koperasi untuk tanggal {{ \Carbon\Carbon::parse($data[0]->tanggal)->translatedFormat('d F Y') }} :</p>
      
      <table class="blueTable">
        <thead>
            <tr>
                <th>NOMOR KWITANSI</th>
                <th>NAMA</th>
                {{-- <th>TANGGAL</th> --}}
                <th>KETERANGAN</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @php ($jumlah = 0)
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->no_kwitansi }}</td>
                <td>{{ $item->nama }}</td>
                {{-- <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td> --}}
                <td>{{ $item->keterangan }}</td>
                <td>@currency($item->jumlah)</td>
            </tr>
            @php ($jumlah += $item->jumlah)
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="td-totalJumlah" colspan="3"><strong>TOTAL JUMLAH</strong></td>
                <td>@currency($jumlah)</td>
            </tr>
        </tfoot>
        </table>
    </div>
    <div class="closing">
      <p>Jakarta, {{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
      <p>Ketua Koperasi,</p>
      <br><br><br>
      <p><u><strong>Sri Anggraeni Megarasih, S.Pd.</strong></u></p>
      <p>NIP. 190809252022212017</p>
    </div>
  </div>
</body>
</html>
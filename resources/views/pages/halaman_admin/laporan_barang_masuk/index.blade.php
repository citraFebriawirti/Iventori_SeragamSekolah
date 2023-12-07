<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN UJIAN</title>
</head>
<style>
    .table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: center;
        padding: 10px;
    }

    th {
        background-color: #333;
        color: white;
    }

    td {
        background-color: #f2f2f2;
    }

    .table,
    th,
    td {
        border: 1px solid #ddd;
    }

    .table:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <table style="width: 100%;">
        <tr style="background-color: white; border:none;">
          
            <td style="background-color: white; border:none; width:80%;">
                <h3 style="font-weight:normal; line-height:1;">
                    TOKO MAHMUDA <br>
                    <span style="font-size: 14px; text-transform:uppercase">
                    produksi dan penjualan pakaian seragam sekolah
                    </span> <br>
                    <span style="font-size:12px;">
                        Jl. Mangga Raya No.66, Kuranji, Kec. Kuranji, Kota Padang, Sumatera Barat
                    </span>
                </h3>
            </td>
           
        </tr>
    </table>
    <hr>
    <table style="width: 100%;">
        <tr style="background-color: white; border:none;">
            <td style="background-color: white; border:none;">
                <h3 style="font-size: 15px; text-transform:uppercase; font-weight:normal;">
                    LAPORAN BARANG MASUK
                    
                </h3>
            </td>
        </tr>
    </table>
    <div style="margin-top: 30px; font-size:small;">
        <table class="table">
            <thead>
                <tr>
                    <th class="border border-slate-200 text-center">No</th>
                    <th class="border border-slate-200 text-center">Nama Barang</th>
                    <th class="border border-slate-200  text-center">Tanggal Masuk</th>
                    <th class="border border-slate-200 text-center">Nama Ekspedisi</th>
                    <th class="border border-slate-200  text-center">Jumlah</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($barang_masuk as $baris)
                    <tr>
                        <td class="border border-slate-200 text-center">{{ $loop->iteration }}</td>
                       
                        <td class="border border-slate-200 whitespace-pre-line text-center">
                            {{ $baris->nama_barang}}
                        </td>                        

                        <td class="border border-slate-200 whitespace-pre-line text-center">
                            {{ $baris->tanggal_barang_masuk }}
                        </td>
                        
                        <td class="border border-slate-200 whitespace-pre-line text-center">
                            {{ $baris->nama_ekspedisi}}
                        </td>

                        <td class="border border-slate-200 whitespace-pre-line text-center">
                            {{ $baris->jumlah_barang_masuk }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="3" style="text-align: right;">Total </td>
                    <td style="text-align:center;">{{ $jumlahBarangMasuk }}</td>
                </tr>
            </tbody>
        </table>

        {{-- <p style="text-align:right; margin-right:80px; margin-top:60px;">
            Batusangkar, {{ date('d / m / Y') }} <br> <br> <br> <span>{{ $userlogin->nama_guru }}</span> <br>
            <span>Pengampu</span>
        </p> --}}
    </div>
</body>

</html>

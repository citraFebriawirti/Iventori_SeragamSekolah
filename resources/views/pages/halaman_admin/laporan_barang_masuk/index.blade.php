<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN BARANG MASUK</title>
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
        background-color: #6a0dad; /* Ubah warna background th menjadi ungu */
        color: white;
    }

    td {
        background-color: #d3adf7; /* Ubah warna background td menjadi ungu muda */
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
                    <th class="border border-slate-200  text-center">Harga Per Item</th>
                    
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
                    <td class="border border-slate-200 whitespace-pre-line text-center">
                        Rp {{ number_format($baris->harga_barang, 0, ',', '.') }}
                    </td>
                    
                   
                </tr>
                @endforeach
               
                <tr>
                   
                    <td colspan="4" style="text-align: right;">Total Jumlah </td>
                    <td style="text-align:center;">{{ $jumlahBarangMasuk }}</td>
                    <td></td>
                </tr>
                <tr>
                   
                    <td colspan="4" style="text-align: right;">Total Harga</td>
                    <td></td>
                    <td style="text-align:center;">Rp {{ number_format($hargaBarangMasuk * $jumlahBarangMasuk, 0, ',', '.') }}</td>

                </tr>
            </tbody>
        </table>

        <p style="text-align:right; margin-right:20px; margin-top:60px;">
            Padang, {{ date('d / m / Y') }} <br> <br> <br> <span></span> <br>
            <span>Owner Toko Mahmuda</span>
        </p>
    </div>
</body>

</html>

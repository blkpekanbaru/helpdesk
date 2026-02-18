<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Form Pemeliharaan/Perbaikan</title>

    <style>
        @page {
            margin: 18px 18px 18px 18px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td,
        .table th {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .no-border td,
        .no-border th {
            border: none !important;
            padding: 0;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: 700;
        }

        .header-title {
            font-size: 13px;
            font-weight: 700;
            line-height: 1.25;
        }

        .sub-title {
            font-size: 10px;
            line-height: 1.2;
        }

        .small {
            font-size: 9px;
        }

        .line {
            border-top: 1px solid #000;
            margin: 6px 0 10px;
        }

        .field-row td {
            border: none;
            padding: 2px 0;
        }

        .dots {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 260px;
            height: 12px;
        }

        .dots-sm {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 160px;
            height: 12px;
        }

        .dots-lg {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 320px;
            height: 12px;
        }

        .box {
            border: 1px solid #000;
            height: 95px;
            padding: 6px;
        }

        .checkbox {
            display: inline-block;
            border: 1px solid #000;
            width: 11px;
            height: 11px;
            vertical-align: middle;
            margin-right: 6px;
        }

        .cb-row {
            margin: 3px 0;
        }

        .h-70 {
            height: 70px;
        }

        .h-55 {
            height: 55px;
        }

        .h-35 {
            height: 35px;
        }

        .mt-6 {
            margin-top: 6px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-14 {
            margin-top: 14px;
        }

        .mb-6 {
            margin-bottom: 6px;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <table class="table no-border" style="margin-bottom: 6px;">
        <tr>
            <td style="width:70px;">
                <img src="{{ public_path('template/dist/assets/images/logo_satpel_mini.png') }}" width="60">
            </td>
            <td class="center">
                <div class="header-title">KEMENTERIAN KETENAGAKERJAAN REPUBLIK INDONESIA</div>
                <div class="header-title">DIREKTORAT JENDERAL</div>
                <div class="header-title">PEMBINAAN PELATIHAN VOKASI DAN PRODUKTIVITAS</div>
                <div class="header-title">BALAI PELATIHAN VOKASI DAN PRODUKTIVITAS</div>
                <div class="sub-title">Alamat kantor / jalan / kota, kode pos, telepon/faks</div>
                <div class="small">Website: xxxxx • Email: xxxxx • Laman: xxxxx</div>
            </td>
            <td style="width:70px;"></td>
        </tr>
    </table>
    <div class="line"></div>

    {{-- JUDUL --}}
    <div class="center bold" style="font-size:13px;">FORM PEMELIHARAAN/PERBAIKAN</div>
    <div class="center small" style="margin-top:2px;">
        Nomor: {{ $nomor_form ?? '2.8/UM.01.01/2025' }}
    </div>

    {{-- IDENTITAS --}}
    <table class="table no-border mt-10">
        <tr class="field-row">
            <td style="width:170px;" class="bold">NAMA PEMOHON</td>
            <td style="width:10px;">:</td>
            <td><span class="dots-lg">{{ $proyek->nama_pemohon ?? '' }}</span></td>
        </tr>
        <tr class="field-row">
            <td class="bold">BAGIAN/BIDANG/KEJURUAN</td>
            <td>:</td>
            <td><span class="dots-lg">{{ $proyek->bagian ?? '' }}</span></td>
        </tr>
        <tr class="field-row">
            <td class="bold">OBJEK PEMELIHARAAN</td>
            <td>:</td>
            <td><span class="dots-lg">{{ $proyek->objek ?? $proyek->nama_proyek }}</span></td>
        </tr>
    </table>

    {{-- DESKRIPSI MASALAH --}}
    <table class="table mt-10">
        <tr>
            <th class="center">Deskripsi Masalah</th>
        </tr>
        <tr>
            <td>
                <div class="box">
                    {{ $proyek->deskripsi ?? '' }}
                </div>
            </td>
        </tr>
    </table>

    {{-- TANDA TANGAN --}}
    <table class="table mt-10">
        <tr>
            <th class="center">Dilaporkan,<br><span class="small">Teknisi Pemeliharaan Sarpras</span></th>
            <th class="center">Diketahui,<br><span class="small">Kepala Sub Bagian Umum</span></th>
            <th class="center">Penanggung Jawab,<br><span class="small">Pejabat Pembuat Komitmen</span></th>
        </tr>
        <tr>
            <td class="h-70"></td>
            <td class="h-70"></td>
            <td class="h-70"></td>
        </tr>
        <tr>
            <td>
                <div>Nama : <span class="dots-sm">{{ $ttd_teknisi_nama ?? '' }}</span></div>
                <div>NIP&nbsp;&nbsp;&nbsp; : <span class="dots-sm">{{ $ttd_teknisi_nip ?? '' }}</span></div>
            </td>
            <td>
                <div>Nama : <span class="dots-sm">{{ $ttd_kasubbag_nama ?? '' }}</span></div>
                <div>NIP&nbsp;&nbsp;&nbsp; : <span class="dots-sm">{{ $ttd_kasubbag_nip ?? '' }}</span></div>
            </td>
            <td>
                <div>Nama : <span class="dots-sm">{{ $ttd_ppk_nama ?? '' }}</span></div>
                <div>NIP&nbsp;&nbsp;&nbsp; : <span class="dots-sm">{{ $ttd_ppk_nip ?? '' }}</span></div>
            </td>
        </tr>
    </table>

    {{-- BLOK RENCANA + KEPUTUSAN + PETUGAS --}}
    <table class="table mt-10">
        <tr>
            <th class="center">Rencana Penyelesaian:</th>
            <th class="center">Keputusan PPK:</th>
            <th class="center">Petugas Penyelesaian:</th>
        </tr>
        <tr>
            <td>
                <div class="cb-row"><span class="checkbox"></span>Diperbaiki sendiri</div>
                <div class="cb-row"><span class="checkbox"></span>Diperbaiki melalui penggantian sparepart</div>
                <div class="cb-row"><span class="checkbox"></span>Diperbaiki melalui vendor / pihak ke 3</div>
                <div class="cb-row">No. Hp Vendor : <span class="dots-sm">{{ $vendor_hp ?? '' }}</span></div>
                <div class="cb-row">Nama Vendor : <span class="dots-sm">{{ $vendor_nama ?? '' }}</span></div>
                <div class="cb-row"><span class="checkbox"></span>Tidak dapat diperbaiki / Rusak berat</div>
            </td>
            <td>
                <div class="cb-row"><span class="checkbox"></span>Disetujui</div>
                <div class="cb-row"><span class="checkbox"></span>Ditolak</div>

                <div class="mt-10 bold">Jenis Pekerjaan:</div>
                <div class="cb-row"><span class="checkbox"></span>Perbaikan</div>
                <div class="cb-row"><span class="checkbox"></span>Pemeliharaan</div>
                <div class="cb-row"><span class="checkbox"></span>Pembelian/Penggantian Alat</div>
            </td>
            <td class="h-55">
                <div class="h-35"></div>
                <div>.................................................</div>
            </td>
        </tr>
    </table>

    {{-- TIMELINE + SERAH TERIMA --}}
    <table class="table mt-10">
        <tr>
            <td style="width:42%; padding:0;">
                <table class="table" style="border:none;">
                    <tr>
                        <th class="center" colspan="2">Tanggal Timeline</th>
                    </tr>
                    <tr>
                        <td style="width:35%;">Tgl. Lapor</td>
                        <td>{{ $tgl_lapor ?? ($proyek->tgl_mulai ?? '') }}</td>
                    </tr>
                    <tr>
                        <td>Tgl. Proses</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tgl. Selesai</td>
                        <td>{{ $proyek->deadline ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="center" colspan="2">Kode MAK</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="h-35"></td>
                    </tr>
                    <tr>
                        <th class="center" colspan="2">Perkiraan Biaya</th>
                    </tr>
                    <tr>
                        <td style="width:35%;">Rp.</td>
                        <td>{{ $perkiraan_biaya ?? '' }}</td>
                    </tr>
                </table>
            </td>

            <td style="width:58%;">
                <div class="bold center mb-6" style="color:#b00000;">Serah Terima Alat/Barang:</div>

                <table class="table">
                    <tr>
                        <th class="center" colspan="2">Pemohon</th>
                        <th class="center" colspan="2">Vendor</th>
                    </tr>
                    <tr>
                        <th class="center small">Diserahkan ke Umum</th>
                        <th class="center small">Diterima Kejuruan</th>
                        <th class="center small">Diterima Vendor</th>
                        <th class="center small">Dikembalikan ke Umum</th>
                    </tr>
                    <tr>
                        <td class="h-55"></td>
                        <td class="h-55"></td>
                        <td class="h-55"></td>
                        <td class="h-55"></td>
                    </tr>
                    <tr>
                        <td class="small">Tgl. :</td>
                        <td class="small">Tgl. :</td>
                        <td class="small">Tgl. :</td>
                        <td class="small">Tgl. :</td>
                    </tr>
                </table>

                <div class="mt-10">
                    <span class="checkbox"></span>Diproses
                    <span style="display:inline-block; width:25px;"></span>
                    <span class="checkbox"></span>Diajukan Pembayaran
                    <span style="display:inline-block; width:25px;"></span>
                    <span class="checkbox"></span>Selesai
                </div>
            </td>
        </tr>
    </table>

</body>

</html>

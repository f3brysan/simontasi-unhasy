<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style>
        @page {
            margin-top: 3cm;
            margin-left: 2.50cm;
            margin-right: 2.00cm;
            margin-bottom: 2cm;
        }

        table.custom {
            font-size: 11pt;
            font-family: 'Times New Roman', Times, serif;
            color: black;
            padding: 5px;
            border-spacing: 30px;
            height: auto;
        }

        thead.custom {
            font-size: 10pt;
            text-align: center;
        }

        .page_break {
            page-break-before: always;
        }

        header {
            position: fixed;
            text-align: right;
            left: 0px;
            right: 0px;
            height: 60px;
            margin-top: -2.5cm;
            font-size: 12pt;
            font-family: 'Times New Roman', Times, serif;
            color: gray;
        }
    </style>
</head>

<body>
    @foreach ($dosen as $dosens)    
        @if ($dosens->tipe == 'B')   
        <header>
            <table width="100%" height="100%" border="0" class="custom" style="border-collapse: collapse">
                <tr>
                    <td style="text-align: center"><img src="assets/img/KOP_FTI_UNHASY.jpg" width="100%"
                            alt=""></td>
                </tr>
            </table>
        </header>                 
            <div>
                <h3 align="center"><u>{{ $title }}</u></h3>
                <table width="100%" height="100%" border="0" class="custom" style="border-collapse: collapse">
                    <tr>
                        <td style="text-align: left; width:2%">1.</td>
                        <td style="width: 15%">Tempat</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 20%">Gedung : {{ $jadwal->gedung }}, Ruang : {{ $jadwal->ruang }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">2.</td>
                        <td style="width: 15%">Hari/Tanggal</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%">
                            {{ \Carbon\Carbon::parse($jadwal->awal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">3.</td>
                        <td style="width: 15%">Judul</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%">{!! trim($dataProposal->title) !!}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">4.</td>
                        <td style="width: 15%">Semester</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">5.</td>
                        <td style="width: 15%">Waktu</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%">{{ \Carbon\Carbon::parse($jadwal->awal)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($jadwal->akhir)->format('H:i') }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">6.</td>
                        <td style="width: 15%">Nama Mahasiswa</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%">{{ $users->nama }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">7.</td>
                        <td style="width: 15%">NIM</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%">{{ $dataProposal->no_induk }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width:2%">8.</td>
                        <td style="width: 15%">Panitia Seminar</td>
                        <td style="width: 1%">:</td>
                        <td style="width: 50%"> - </td>
                    </tr>
                </table>
                <p>Anggoa Penguji :</p>
                <table width="100%" height="100%" border="1" class="custom" style="border-collapse: collapse">
                    <thead>
                        <tr>
                            <th colspan="2">Nama</th>
                            <th>Keterangan</th>
                            <th>Tanda Tangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dosen as $dsn)
                            <tr>
                                <td style="width: 15%">Penguji {{ $loop->iteration }}</td>
                                <td style="text-align: center">{{ $dsn->nama }}</td>
                                <td style="width: 25%; text-align: center">Diterima / Tidak *</td>
                                <td style="width: 20%; height: 30px; text-align: center">{{ $loop->iteration }}.
                                    .................
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Dapat Dilanjutkan/Diterima Dengan Catatan:</p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <table class="custom" style="width: 50%; margin-left: 50%">
                    <tr>
                        <td>Jombang,
                            {{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr style="height: 100px">
                        <td></td>
                    </tr>
                    <tr>
                        <td><u>{{ $dosens->nama }}</u><br>NIY : {{ $dosens->nip }}</td>
                    </tr>
                </table>
                <p style="font-size: 10pt">NB : <br>
                    * . Coret Yang tidak Perlu<br>
                    <b>- Form ini harap segera diserahkan ke Staff Fakultas Setelah selesai Sidang, Apabila dalam 1
                        minggu
                        setelah
                        pelaksanaan sidang proposal tidak diserahkan maka status proposal dianggap TOLAK.</b>
                </p>
            </div>
            <div class="page_break"></div>
            <div>
                <table width="100%" height="100%" border="0" class="custom" style="border-collapse: collapse">
                    <tr>
                        <td style="width: 25%">Judul Proposal</td>
                        <td style="width: 3%">:</td>
                        <td>{!! $dataProposal->title !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Nama Mahasiswa</td>
                        <td style="width: 3%">:</td>
                        <td>{{ $users->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">NIM</td>
                        <td style="width: 3%">:</td>
                        <td>{{ $dataProposal->no_induk }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Tanggal</td>
                        <td style="width: 3%">:</td>
                        <td>{{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Status<br>Proposal Skripsi *</td>
                        <td style="width: 3%">:</td>
                        <td>
                            <table width="100%" height="100%" border="1" class="custom"
                                style="border-collapse: collapse">
                                <tr style="text-align: center; height: 100px">
                                    <td style="height: 50px; border: 1px">OK</td>
                                    <td style="height: 50px; border: 1px">REVISI</td>
                                    <td style="height: 50px; border: 1px">TOLAK</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <p>Catatan :</p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <table class="custom" style="width: 50%; margin-left: 50%">
                    <tr>
                        <td>Jombang,
                            {{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr style="height: 100px">
                        <td></td>
                    </tr>
                    <tr>
                        <td><u>{{ $dosens->nama }}</u><br>NIY : {{ $dosens->nip }}</td>
                    </tr>
                </table>
                <p style="font-size: 10pt">NB : <br>
                    * . Coret Yang tidak Perlu<br>
                    <b>- Form ini harap segera diserahkan ke Staff Fakultas Setelah selesai Sidang, Apabila dalam 1
                        minggu
                        setelah
                        pelaksanaan sidang proposal tidak diserahkan maka status proposal dianggap TOLAK.</b>
                </p>
            </div>
            <div class="page_break"></div>
            <div>
                <h3 align="center">RANGKUMAN HASIL SEMINAR PROPOSAL SKRIPSI</h3>
                <table width="100%" height="100%" border="0" class="custom"
                    style="border-collapse: collapse">
                    <tr>
                        <td style="width: 25%">Judul Proposal</td>
                        <td style="width: 3%">:</td>
                        <td>{!! $dataProposal->title !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Nama Mahasiswa</td>
                        <td style="width: 3%">:</td>
                        <td>{{ $users->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">NIM</td>
                        <td style="width: 3%">:</td>
                        <td>{{ $dataProposal->no_induk }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Tanggal</td>
                        <td style="width: 3%">:</td>
                        <td>{{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                </table>
                <br>
                <table width="100%" height="100%" border="1" class="custom"
                    style="border-collapse: collapse">
                    <tr>
                        <td style="width: 10%; text-align: center">No.</td>
                        <td style="width: 90%; text-align: center">Aspek yang perlu diperbaiki</td>
                    </tr>
                    <tr>
                        <td style="height: 250px"></td>
                        <td style="height: 250px"></td>
                    </tr>
                </table>
                <p>Catatan :</p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <table class="custom" style="width: 50%; margin-left: 50%">
                    <tr>
                        <td>Jombang,
                            {{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr style="height: 100px">
                        <td></td>
                    </tr>
                    <tr>
                        <td><u>{{ $dosens->nama }}</u><br>NIY : {{ $dosens->nip }}</td>
                    </tr>
                </table>
            </div>            
        @else
        <div class="page_break"></div>
            <div>
                <h3 align="center">RANGKUMAN HASIL SEMINAR PROPOSAL SKRIPSI</h3>
                <table width="100%" height="100%" border="0" class="custom"
                    style="border-collapse: collapse">
                    <tr>
                        <td style="width: 25%">Judul Proposal</td>
                        <td style="width: 3%">:</td>
                        <td>{!! $dataProposal->title !!}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Nama Mahasiswa</td>
                        <td style="width: 3%">:</td>
                        <td>{{ $users->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">NIM</td>
                        <td style="width: 3%">:</td>
                        <td>{{ $dataProposal->no_induk }}</td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Tanggal</td>
                        <td style="width: 3%">:</td>
                        <td>{{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                </table>
                <br>
                <table width="100%" height="100%" border="1" class="custom"
                    style="border-collapse: collapse">
                    <tr>
                        <td style="width: 10%; text-align: center">No.</td>
                        <td style="width: 90%; text-align: center">Aspek yang perlu diperbaiki</td>
                    </tr>
                    <tr>
                        <td style="height: 250px"></td>
                        <td style="height: 250px"></td>
                    </tr>
                </table>
                <p>Catatan :</p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <p style="text-align: justify; width: 100%">
                    ......................................................................................................................................................
                </p>
                <table class="custom" style="width: 50%; margin-left: 50%">
                    <tr>
                        <td>Jombang,
                            {{ \Carbon\Carbon::parse(date($jadwal->awal))->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                    </tr>
                    <tr style="height: 100px">
                        <td></td>
                    </tr>
                    <tr>
                        <td><u>{{ $dosens->nama }}</u><br>NIY : {{ $dosens->nip }}</td>
                    </tr>
                </table>
            </div>            
        @endif
    @endforeach

</body>

</html>

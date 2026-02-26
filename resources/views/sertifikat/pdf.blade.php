p
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>


    <style>
        /* cyrillic-ext */

        @page {
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center;
        }

        html,
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ public_path('storage/' . $peserta->batch->sertifikat->background) }}');
            background-size: cover;
        }

        .page {
            height: 100vh;
            margin: 50px;
            /* background-image: url('{{ asset('img/background/sertifikat.png') }}'); */
        }

        .page-break {
            page-break-after: always;
        }

        .nama {
            font-size: 32px;
            font-weight: bold;
            /* margin-top: 40px; */
        }

        .qr {
            margin-top: 30px;
        }

        hr {
            border: 1px solid #dfcc8d;
            /* width: 80%; */
            margin: 20px auto;
        }

        #footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .w-50 {
            display: inline;
            width: 50%;
        }

        h1 {
            color: #172954;
        }

        p {
            margin: 0;
            padding: 0;
        }


        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            /* background-color: #f2f2f2; */
        }

        th.table {
            border: 2px solid #172954;
            padding: 12px;
            text-align: center;
            font-weight: bold;
        }

        td.table {
            border: 2px solid #172954;
            padding: 10px;
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="page">
        <div id="header" class="text-center">
            <img src="{{ public_path('img/logo/logo_transparant.png') }}" alt="logo" style="height: 80px; margin-top: 50px;">
            <h1>CERTIFICATE</h1>
            <p style="font-style: italic;">No: {{ $peserta->no_sertifikat }}</p>
        </div>

        <hr>

        <div id="content" class="text-center">
            <div id="profile">
                <p>This certificate has been awarded to:</p>
                <div class="nama">
                    {{ $peserta->nama }}
                </div>
                <img src="{{ public_path('storage/' . $peserta->foto) }}" style="height: 100px; margin: 30px 0 30px 0;">
            </div>

            <div id="body">
                <p style="margin-top:10px; font-size: 20px; line-height: 1.5;"> Has successfully participated in and passed the competency assessment of the training program entitled
                    <strong>{{ $peserta->batch->sertifikat->judul }}</strong>, organized by PT. Teknikal Karya Service, held on
                    @if ($peserta->batch->tanggal_mulai && $peserta->batch->tanggal_selesai)
                        {{ \Carbon\Carbon::parse($peserta->batch->tanggal_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($peserta->batch->tanggal_selesai)->translatedFormat('d F Y') }}
                    @else
                        {{ \Carbon\Carbon::parse($peserta->batch->tanggal_mulai)->translatedFormat('d F Y') }}
                    @endif in Batam City
                </p>
            </div>
        </div>

        <div id="footer" class="text-center" style="margin-top: 50px">
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <div class="text-center">
                            <img src="{{ public_path('storage/' . $peserta->qr_code) }}" style="height: 100px; margin-top: 30px;">
                            <p style="font-size: 12px; margin-top: 10px;">
                                To Verify this certificate visit:
                                <br>
                                www.teknikalkaryaservice.com
                                <br>
                                or scan the QR code above
                            </p>
                        </div>
                    </td>
                    <td width="50%" style="vertical-align: top; margin-end: 0;">
                        <div class="text-center">
                            <img src="{{ public_path('storage/' . $peserta->batch->sertifikat->ttd_pejabat) }}" style="height: 100px; margin-top: 30px;">
                            <p style="font-weight: bold; margin-top:10px;">{{ $peserta->batch->sertifikat->nama_pejabat }}</p>
                            <p>{{ $peserta->batch->sertifikat->nama_jabatan }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="page">

        <img src="{{ public_path('img/logo/logo_transparant.png') }}" alt="logo" style="height: 50px;">

        <h3 class="text-center" style="color:#172954">Assessment Results</h3>

        <table style="margin-top:10px;">
            <thead>
                <tr>
                    <th scope="col" class="table">
                        Unit Number
                    </th>
                    <th scope="col" class="table">
                        Unit Title
                    </th>
                    <th scope="col" class="table">
                        S/NS
                    </th>
            </thead>
            <tbody>
                @foreach ($peserta->batch->sertifikat->details as $unit)
                    <tr>
                        <td class="text-center table" width="20%">
                            {{ $unit->unit_number ?? '' }}
                        </td>
                        <td class="table" width="60%">
                            {{ $unit->unit_title ?? '' }}
                        </td>
                        <td class="text-center table" width="20%">
                            S
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-size:20px; margin-top:10px; line-height: 1.5;">A result of ‘S’ is satisfactory. Where a result Not Satisfactory ‘NS’ is recorded further training may be required.</p>

        <h2 class="text-center">END OF STATEMENT</h2>

        <div id="footer_page2" class="text-center" style="margin-top: 50px">

            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="50%" style="vertical-align: top;">
                        <div class="text-center">
                            <img src="{{ public_path('storage/' . $peserta->qr_code) }}" style="height: 100px; margin-top: 30px;">
                            <p style="font-size: 12px; margin-top: 10px;">
                                To Verify this certificate visit:
                                <br>
                                www.teknikalkaryaservice.com
                                <br>
                                or scan the QR code above
                            </p>
                        </div>
                    </td>
                    <td width="50%" style="vertical-align: top; margin-end: 0;">
                        <div class="text-center">
                            <img src="{{ public_path('storage/' . $peserta->batch->sertifikat->ttd_pejabat) }}" style="height: 100px; margin-top: 30px;">
                            <p style="font-weight: bold; margin-top:10px;">{{ $peserta->batch->sertifikat->nama_pejabat }}</p>
                            <p>{{ $peserta->batch->sertifikat->nama_jabatan }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>

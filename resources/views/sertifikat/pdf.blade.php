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
            size: A4;
        }

        .text-center {
            text-align: center;
        }

        html,
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 210mm;
            height: 297mm;
        }

        .page {
            width: 210mm;
            height: 297mm;
            /* ✅ fixed height, bukan min-height */
            position: relative;
            overflow: hidden;
            /* page-break-after: always; */
        }

        .page-break-after {
            page-break-after: always;
        }

        .content {
            position: relative;
            z-index: 1;
            padding: 50px;
        }


        .qr {
            margin-top: 30px;
        }

        hr {
            border: 1px solid #dfcc8d;
            /* width: 80%; */
            margin: 10px auto;
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
    <div class="page page-break-after">
        <img class="bg-image" src="{{ public_path('storage/' . $peserta->batch->sertifikat->background_page_one) }}">
        <div class="content">
            <div id="header">
                <img class="text-left" src="{{ public_path('storage/' . $peserta->batch->sertifikat->logo) }}" alt="logo" style="height: 100px;">
                <h1 class="text-center">{{ $peserta->batch->sertifikat->jenis_sertifikat }}</h1>
                <p class="text-center" style="font-style: italic;">Certificate No: {{ $peserta->no_sertifikat }}</p>
            </div>
            <hr>
            <div id="content" class="text-center">
                <div id="profile">
                    <table width="100%">
                        <tr>
                            <td class="width: 70%">
                                <p style="font-size:20px;">This certificate has been awarded to:</p>
                                <div style="font-size: 32px;font-weight: bold;margin: 20px 0px 10px 0%; word-wrap:break-word;">
                                    {{ $peserta->nama }}
                                </div>
                            </td>
                            <td class="width 30%">
                                <img src="{{ public_path('storage/' . $peserta->foto) }}" style="height: 200px; margin: 10px 0 10px 0;">
                            </td>
                        </tr>
                        <tr>
                            <td class="width:100%">
                                <p style="font-size:20px; font-weight:bold">Date Issued: <span style="font-weight:normal"> {{ \Carbon\Carbon::parse($peserta->batch->date_issued)->translatedFormat('d F Y') }}</span> </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div id="body">
                    <p style="text-align:justify; margin-top:10px; font-size: 20px; line-height: 1.2;"> {{ $peserta->batch->deskripsi }} </p>
                </div>
            </div>
            <div id="footer" class="text-center" style="margin-top: 20px">
                <table width="100%" style="border-collapse: collapse;">
                    <tr>
                        <td width="50%" style="vertical-align: middle; text-align: center; padding:5px;">
                            @if ($peserta->batch->left_nama_pejabat)
                                <div style="position: relative; width: 150px; height: 120px; margin: 0 auto;">
                                    @if ($peserta->batch->left_stamp)
                                        <img src="{{ public_path('storage/' . $peserta->batch->left_stamp) }}" style="position: absolute; bottom: 0; left: 0; width: 150px; opacity: 0.85; z-index: 1;">
                                    @endif
                                    @if ($peserta->batch->right_ttd_pejabat)
                                        <img src="{{ public_path('storage/' . $peserta->batch->right_ttd_pejabat) }}" style="position: absolute; top: 10px; right: 0; height: 150px; z-index: 2;">
                                    @endif
                                </div>
                                <p style="font-weight: bold;">{{ $peserta->batch->right_nama_pejabat }}</p>
                                <p>{{ $peserta->batch->right_nama_jabatan }}</p>
                            @else
                                <img src="{{ public_path('storage/' . $peserta->qr_code) }}" style="height: 100px;">
                                <p style="font-size: 12px; margin-top: 10px;">
                                    To Verify this certificate visit:<br>
                                    www.teknikalkaryaservice.com<br>
                                    or scan the QR code above
                                </p>
                            @endif
                        </td>
                        <td width="50%" style="vertical-align: middle; text-align: center; padding:5px;">
                            <div style="position: relative; width: 150px; height: 120px; margin: 0 auto;">
                                @if ($peserta->batch->right_stamp)
                                    <img src="{{ public_path('storage/' . $peserta->batch->right_stamp) }}" style="position: absolute; top: 0; left: 0; height: 150px; opacity: 0.85; z-index: 1;">
                                @endif
                                @if ($peserta->batch->right_ttd_pejabat)
                                    <img src="{{ public_path('storage/' . $peserta->batch->right_ttd_pejabat) }}" style="position: absolute; top: 10px; right: 0; height: 150px; z-index: 2;">
                                @endif
                            </div>
                            <p style="font-weight: bold;">{{ $peserta->batch->right_nama_pejabat }}</p>
                            <p>{{ $peserta->batch->right_nama_jabatan }}</p>
                        </td>
                    </tr>
                    @if ($peserta->batch->left_nama_pejabat)
                        <tr>
                            <td colspan="2" style="text-align: center; padding: 10px;">
                                <img src="{{ public_path('storage/' . $peserta->qr_code) }}" style="height: 100px;">
                                <p style="font-size: 12px; margin-top: 10px;">
                                    To Verify this certificate visit:<br>
                                    www.teknikalkaryaservice.com<br>
                                    or scan the QR code above
                                </p>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>


    <div class="page">
        {{-- ✅ Background page two --}}
        <img class="bg-image" src="{{ public_path('storage/' . $peserta->batch->sertifikat->background_page_two) }}">

        <div class="content">
            <div class="text-right">
                <img class="text-right" src="{{ public_path('storage/' . $peserta->batch->sertifikat->logo) }}" alt="logo" style="height: 80px;">
            </div>

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

            <p style="font-size:20px; margin-top:10px; line-height: 1.25;">A result of ‘S’ is satisfactory. Where a result Not Satisfactory ‘NS’ is recorded further training may be required.</p>

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
                                <div style="position: relative; width: 150px; height: 120px; margin: 0px auto 0 auto;">
                                    <img src="{{ public_path('storage/' . $peserta->batch->right_stamp) }}" style="position: absolute; top: 0; left: 0; height: 150px; opacity: 0.85; z-index: 1;">
                                    <img src="{{ public_path('storage/' . $peserta->batch->right_ttd_pejabat) }}" style="position: absolute; top: 10px; right: 0;height: 150px; z-index: 2;">
                                </div>
                                <p style="font-weight: bold; margin-top: 10px;">{{ $peserta->batch->right_nama_pejabat }}</p>
                                <p>{{ $peserta->batch->right_nama_jabatan }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

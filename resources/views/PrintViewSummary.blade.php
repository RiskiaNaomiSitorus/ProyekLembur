<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <title>Cetak Rekapitulasi Lembur</title>
    <style>
        /* Add some styles for printing */
        @media print {
            body {
                font-family: Arial, sans-serif;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
            }
            .table th, .table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .table th {
                background-color: #f2f2f2;
            }
            .table tfoot tr {
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rekapitulasi Lembur</h1>
        <table class="table table-striped table-bordered" id="summaryTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah Jam Kerja Lembur</th>
                    <th>Jumlah Upah Lembur</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($groupedRecords as $namaLengkap => $totals)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $namaLengkap }}</td>
                    <td>{{ number_format($totals['totalJamKerja'], 1, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totals['totalUpahLembur'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ number_format($totalJamKerja, 1, ',', '.') }}</td>
                    <td>Rp. {{ number_format($totalUpahLembur, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <script>
            window.print();
        </script>
    </div>
</body>
</html>

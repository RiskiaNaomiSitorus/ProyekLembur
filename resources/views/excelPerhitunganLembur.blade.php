<!DOCTYPE html>
<html>
<head>
</head>
<body>

@if(!empty($lemburData))
    @php
        $firstLembur = $lemburData->first();
        $nama = $namaLengkap;
        $jabatan = $firstLembur->jabatan ?? 'N/A';
        $gaji = (float) ($firstLembur->gaji ?? 0);
        $upahLemburPerJam = $gaji > 0 ? round($gaji / 173, 2) : 0;
    @endphp

    <label>Nama</label>
    <span class="value">: {{ $nama }}</span><br>

    <label>Jabatan</label>
    <span class="value">: {{ $jabatan }}</span><br>

    @if($startDate && $endDate)
    @php
        $formattedStartDate = \Carbon\Carbon::parse($startDate)->locale('id')->translatedFormat('d F Y');
        $formattedEndDate = \Carbon\Carbon::parse($endDate)->locale('id')->translatedFormat('d F Y');
    @endphp
    <label>Periode</label>
    <span class="value">: {{ $formattedStartDate }} - {{ $formattedEndDate }}</span><br>
    @else
    <label>Periode</label>
    <span class="value">: Tidak ada periode yang ditentukan</span><br>
    @endif

    <label>Gaji Pokok</label>
    <span class="value">: {{ number_format($gaji, 0, ',', '.') }}</span><br>

    <label>Upah lembur per jam</label>
    <span class="value">: {{ number_format($gaji, 0, ',', '.') }} / 173 = {{ number_format($upahLemburPerJam, 2, ',', '.') }}</span>

@else
    <p>No records found for the given criteria.</p>
@endif

    <div class="spacer"></div>
    <table style="border: 1px solid;">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Hari</th>
            <th rowspan="2">Tanggal</th>
            <th colspan="3">Waktu Kerja</th>
            <th colspan="9">Perhitungan Lembur</th>
            <th rowspan="2">Upah Lembur <br> Rp.</th>
            <th rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th>In</th>
            <th>Out</th>
            <th>Total</th>
            <th>Jam I</th>
            <th>x 1.5</th>
            <th>Jam II</th>
            <th>x 2</th>
            <th>Jam IX</th>
            <th>x 3</th>
            <th>Jam X</th>
            <th>x 4</th>
            <th>Total Jam Lembur</th>
        </tr>
    </thead>
    <tbody>
        @php
            // Initialize totals
            $totalJamKerjaLembur = 0;
            $totalJamI = 0;
            $totalJamI1_5 = 0;
            $totalJamII = 0;
            $totalJamII2 = 0;
            $totalJamIII = 0;
            $totalJamIII3 = 0;
            $totalJamIV = 0;
            $totalJamIV4 = 0;
            $totalTotalJamLembur = 0;
            $totalUpahLembur = 0;
        @endphp

        @foreach ($lemburData as $lembur)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($lembur->tanggal_lembur)->locale('id')->translatedFormat('l') }}</td>
            <td>{{ \Carbon\Carbon::parse($lembur->tanggal_lembur)->locale('id')->translatedFormat('d F Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($lembur->jam_masuk)->format('H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($lembur->jam_keluar)->format('H:i') }}</td>
            <td>{{ $lembur['jam_kerja_lembur'] ?? 0 }}</td>
            <td>{{ $lembur['jam_i']  ?? 0}}</td>
            <td>{{ $lembur['jam_i'] * 1.5 }}</td>
            <td>{{ $lembur['jam_ii'] ?? 0 }}</td>
            <td>{{ $lembur['jam_ii'] * 2 }}</td>
            <td>{{ $lembur['jam_iii'] ?? 0 }}</td>
            <td>{{ $lembur['jam_iii'] * 3 }}</td>
            <td>{{ $lembur['jam_iv'] ?? 0 }}</td>
            <td>{{ $lembur['jam_iv'] * 4 }}</td>
            <td>{{ $lembur['total_jam_lembur'] }}</td>
            <td>{{ $lembur['upah_lembur'] }}</td>
            <td>{{ $lembur['keterangan'] }}</td>
            
            @php
                // Accumulate totals
                $totalJamKerjaLembur += $lembur['jam_kerja_lembur'];
                $totalJamI += $lembur['jam_i'];
                $totalJamI1_5 += $lembur['jam_i'] * 1.5;
                $totalJamII += $lembur['jam_ii'];
                $totalJamII2 += $lembur['jam_ii'] * 2;
                $totalJamIII += $lembur['jam_iii'];
                $totalJamIII3 += $lembur['jam_iii'] * 3;
                $totalJamIV += $lembur['jam_iv'];
                $totalJamIV4 += $lembur['jam_iv'] * 4;
                $totalTotalJamLembur += $lembur['total_jam_lembur'];
                $totalUpahLembur += $lembur['upah_lembur'];
            @endphp
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
        <th colspan="5">Total</th>
            <td>{{ $totalJamKerjaLembur }}</td>
            <td>{{ $totalJamI }}</td>
            <td>{{ $totalJamI1_5 }}</td>
            <td>{{ $totalJamII }}</td>
            <td>{{ $totalJamII2 }}</td>
            <td>{{ $totalJamIII }}</td>
            <td>{{ $totalJamIII3 }}</td>
            <td>{{ $totalJamIV }}</td>
            <td>{{ $totalJamIV4 }}</td>
            <td>{{ $totalTotalJamLembur }}</td>
            <td>{{  $totalUpahLembur }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>


</body>
</html>

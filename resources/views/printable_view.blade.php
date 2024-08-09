<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable View</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/styles.css')}}" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
<style>
     /* Add your styles here */
     html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      body {
        display: flex;
        flex-direction: column;
      }
      .wrapper {
        display: flex;
        flex: 1;
      }
      .sidebar {
        width: 250px;
        background: #333;
        color: white;
        padding: 20px;
        box-sizing: border-box;
      }
      .main_content {
        flex: 1;
        padding: 20px;
        box-sizing: border-box;
      }
      .card-header {
        margin: 20px;
        border: 1px solid #11a634;
        border-radius: 0; /* Menghapus border-radius untuk membuat persegi */
        box-shadow: 0 2px 4px rgba(0, 255, 38, 0.1);
        width: 225px; /* Menentukan lebar card */
        height: 40px;
        background-color: #1bbc53;
        color: white;
        display: flex;
        align-items: center; /* Menambahkan padding untuk header */
      }
      .card-header i {
        margin-right: 10px;
      }
      .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 40px;
        margin-left: 20px;
      }
      .header-title {
        display: flex;
        align-items: center;
      }
      .table-container {
        width: 100%;
        margin-left: 5px;
      }
      .table-container table {
        width: 100%;
      }
      table,
      th,
      td {
        border: 1px solid black;
      }
      th,
      td {
        padding: 8px;
        text-align: center;
      }
      th {
        background-color: #f2f2f2;
      }
      .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
      }
      .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        position: relative;
      }
      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }
  </style>
<body>
    <div id="printableView">
        <h2>Lembur Records</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Karyawan</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lembur</th>
                    <th>Jenis Lembur</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Gaji</th>
                    <th>Jam Kerja Lembur</th>
                    <th>Jam I</th>
                    <th>Jam II</th>
                    <th>Jam III</th>
                    <th>Jam IV</th>
                    <th>Upah Lembur</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lemburRecords as $lembur)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lembur['id_karyawan'] }}</td>
                    <td>{{ $lembur['nama_lengkap'] }}</td>
                    <td>{{ $lembur['formatted_tanggal_lembur'] }}</td>
                    <td>{{ $lembur['jenis_lembur'] }}</td>
                    <td>{{ $lembur['jam_masuk'] }}</td>
                    <td>{{ $lembur['jam_keluar'] }}</td>
                    <td>{{ 'Rp. ' . number_format($lembur['gaji'], 0, ',', '.') }}</td>
                    <td>{{ number_format($lembur['jam_kerja_lembur'], 1, ',', '.') }}</td>
                    <td>{{ number_format($lembur['jam_i'], 1, ',', '.') }}</td>
                    <td>{{ number_format($lembur['jam_ii'], 1, ',', '.') }}</td>
                    <td>{{ number_format($lembur['jam_iii'], 1, ',', '.') }}</td>
                    <td>{{ number_format($lembur['jam_iv'], 1, ',', '.') }}</td>
                    <td>{{ 'Rp. ' . number_format($lembur['upah_lembur'], 0, ',', '.') }}</td>
                    <td>{{ $lembur['keterangan'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
        document.getElementById('openPrintModal').addEventListener('click', function() {
    document.getElementById('printModal').style.display = 'block';
});

document.getElementById('closePrintModal').addEventListener('click', function() {
    document.getElementById('printModal').style.display = 'none';
});

document.getElementById('printForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    var form = this;
    var action = form.action;
    var formData = new FormData(form);

    var url = new URL(action);
    url.search = new URLSearchParams(formData).toString();

    window.open(url, '_blank'); // Open the printable view in a new tab

    // Optionally, you can close the modal after submitting
    document.getElementById('printModal').style.display = 'none';
});
document.addEventListener('DOMContentLoaded', function() {
    // Get modal and button elements
    var modal = document.getElementById('printModal');
    var btn = document.getElementById('openPrintModal');
    var span = document.getElementById('closePrintModal');

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = 'block';
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = 'none';
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Handle form submission
    document.getElementById('printForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = new FormData(this);

        // Convert form data to URL query string
        var queryString = new URLSearchParams(formData).toString();

        // Open new tab with the filtered data
        window.open('{{ route('printableView') }}?' + queryString, '_blank');
        
        // Optionally close the modal
        modal.style.display = 'none';
    });
});

    </script>
</body>
</html>

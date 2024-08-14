<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Summary</title>
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
    <style>
        .table-container {
            width: 100%;
            margin-left: 5px;
        }
        .table-container table {
            width: 100%;
        }
        .form-container {
            margin: 20px 0;
        }
        .summary-footer {
            margin-top: 20px;
        }
        .bold {
            font-weight: bold;
        }
        .action-buttons {
            margin-bottom: 10px;
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
        .btn-csv {
            background-color: #28a745;
            color: white;
        }
        .btn-copy {
            background-color: #17a2b8;
            color: white;
        }
        .btn-colvis {
            background-color: #ffc107;
            color: white;
        }
        .btn-print {
            background-color: #6c757d;
            color: white;
        }
        .username {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
        .username i {
            margin-left: 5px;
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
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Lembur</h2>
            <ul>
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('data-karyawan') }}"><i class="fas fa-user"></i> Data Karyawan</a></li>
                <li><a href="{{ route('rekapitulasi-jam-lembur') }}"><i class="fas fa-project-diagram"></i> Rekapitulasi Jam Lembur</a></li>
                <li><a href="{{ route('perhitungan-lembur') }}"><i class="fas fa-address-book"></i> Perhitungan Lembur</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="header">
                <div class="title">PT. Tolan Tiga Indonesia</div>
                <div class="user-info">
                    <i class="fa fa-bell"></i>
                    <div class="dropdown">
                        <div class="username">
                            {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                        </div>
                        <div class="dropdown-content">
                            <a href="{{ url('logout') }}" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info">
                <div class="date"><h5>12 Juli 2024</h5></div>
            </div>
            <div class="header-section">
                <h1>Summary Lembur Karyawan</h1>

                <div class="action-buttons">
                    <button class="btn btn-primary btn-sm" id="exportButton2">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                    <button class="btn btn-secondary btn-sm" id="openPrintModal2">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button class="btn btn-info" id="filterButton2">
    <i class="fa fa-filter" aria-hidden="true"></i> Filter Records
</button>

                </div>

                <div class="table-container">
                    <table class="table table-striped table-bordered" id="summaryTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Jam</th>
                                <th>Jumlah Upah Lembur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($groupedRecords as $namaLengkap => $totals)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $namaLengkap }}</td>
                                    <td>{{ $totals['totalJamKerja'] }}</td>
                                    <td>{{'Rp. '. number_format($totals['totalUpahLembur'] )}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>{{ number_format($totalJamKerja, 1) }}</td>
                                <td>{{ 'Rp. '.number_format($totalUpahLembur, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="dateFilterModal">
    <div class="modal-content">
        <span class="close" id="closedataFilterModal">&times;</span>
        <h2 class="modal-title" id="dateFilterModalLabel">Filter Records</h2>
        <div class="modal-body">
            <form id="filterForm" method="GET" action="">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap5" name="nama_lengkap5">
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date5" name="start_date5">
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date5" name="end_date5">
                </div>       
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                    <button type="button" id="resetFilterButton" class="btn btn-secondary">Reset Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<!-- Print Filter Modal -->
<div id="printModal2" class="modal">
    <div class="modal-content">
        <span class="close" id="closePrintModal">&times;</span>
        <h2 class="modal-title">Print Filters</h2>
        <div class="modal-body">
            <form id="printForm" method="GET" action="{{ route('print.filtered.data') }}" target="_blank">
                @csrf
                <div class="form-group">
                    <label for="printnama_lengkap2">Nama Lengkap</label>
                    <input type="text" class="form-control" id="printnama_lengkap2" name="printnama_lengkap2">
                </div>
                <div class="form-group">
                    <label for="printstart_date">Start Date</label>
                    <input type="date" class="form-control" id="printstart_date" name="printstart_date">
                </div>
                <div class="form-group">
                    <label for="printend_date">End Date</label>
                    <input type="date" class="form-control" id="printend_date" name="printend_date">
                </div>       
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Print Filtered Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Date Range Selection -->
<div id="dateRangeModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closedataRangeModal">&times;</span>
        <h2>Select Date Range</h2>
        <form id="dateRangeForm" action="{{ route('export.filtered.excel') }}" method="GET">
        @csrf
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap_excel" name="nama_lengkap_excel" class="form-control">
    </div>
    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date_excel" name="start_date_excel" required class="form-control">
    </div>
    <div class="form-group">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date_excel" name="end_date_excel" required class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Export</button>
</form>

    </div>
</div>
<script>
  //FILTER
  document.getElementById('filterForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    fetch('{{ route('rekapitulasi-jam-lembur') }}', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Update the table with filtered data
        document.getElementById('table-container').innerHTML = data.table;
        // Update totals
        document.getElementById('totalJamKerja').innerText = data.totalJamKerja;
        document.getElementById('totalUpahLembur').innerText = data.totalUpahLembur;
    })
    .catch(error => console.error('Error:', error));
});


//FILTER
//PRINT
document.addEventListener('DOMContentLoaded', function () {
    const filterModal = document.getElementById('filterModal');
    const filterButton = document.getElementById('filterButton2'); // Ensure this ID matches the button
    const closeModal = filterModal.querySelector('.close');

    // Open and close the modal
    if (filterButton) {
        filterButton.addEventListener('click', function () {
            filterModal.style.display = 'block';
        });
    }

    if (closeModal) {
        closeModal.addEventListener('click', function () {
            filterModal.style.display = 'none';
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target === filterModal) {
            filterModal.style.display = 'none';
        }
    });
});


document.getElementById('filterForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    fetch('{{ route('rekapitulasi-jam-lembur') }}', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Update the table with filtered data
        document.getElementById('table-container').innerHTML = data.table;
        // Update totals
        document.getElementById('totalJamKerja').innerText = data.totalJamKerja;
        document.getElementById('totalUpahLembur').innerText = data.totalUpahLembur;
    })
    .catch(error => console.error('Error:', error));
});

//PRINT

//EXPORT

    document.addEventListener('DOMContentLoaded', function () {
        // Get modal elements
        var exportButton = document.getElementById('exportButton2');
        var dateRangeModal = document.getElementById('dateRangeModal');
        var closeModal = document.getElementById('closedataRangeModal');
        
        // Show the modal
        exportButton.onclick = function() {
            dateRangeModal.style.display = 'block';
        }
        
        // Close the modal
        closeModal.onclick = function() {
            dateRangeModal.style.display = 'none';
        }
        
        // Close the modal if clicking outside of it
        window.onclick = function(event) {
            if (event.target == dateRangeModal) {
                dateRangeModal.style.display = 'none';
            }
        }
    });


//EXPORT
    </script>
</body>
</html>

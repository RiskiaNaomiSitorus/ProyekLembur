<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Perhitungan Lembur</title>
    <link rel="stylesheet" href="{{ asset ('assets/styles.css')}}" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    />
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
  </head>
  <body>
    <div class="wrapper">
      <div class="sidebar">
        <h2>Lembur</h2>
        <ul>
        <li>
    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a>
</li>
<li>
    <a href="{{ route('data-karyawan') }}"><i class="fas fa-user"></i> Data Karyawan</a>
</li>
<li>
    <a href="{{ route('rekapitulasi-jam-lembur') }}"><i class="fas fa-project-diagram"></i> Rekapitulasi Jam Lembur</a>
</li>
<li>
    <a href="{{ route('perhitungan-lembur') }}"><i class="fas fa-address-book"></i> Perhitungan Lembur</a>
</li>
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
              <a href="settings.html">Settings</a>
              <a href="{{ url('logout') }}" class="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
              </div>
            </div>
          </div>
        </div>
        <div class="info">
          <div class="date">
            <h5>12 Juli 2024</h5>
          </div>
        </div>
        <div class="dashboard"><h2>Perhitungan Lembur</h2></div>
        <div class="header-section">
          <div class="card-header" id="tambahDataLembur">
            <i></i>
            <i class="fas fa-plus-circle"></i>
            <h4>Tambah Data Lembur</h4>
          </div>
          <div class="action-buttons">
            <button class="btn btn-primary btn-sm">
              <i class="fas fa-file-excel"></i> Excel
            </button>
            <button class="btn btn-secondary btn-sm">
              <i class="fas fa-print"></i> Print
            </button>
            <button class="btn btn-success btn-sm">
              <i class="fas fa-file-csv"></i> CSV
            </button>
            <button class="btn btn-info btn-sm">
              <i class="fas fa-copy"></i> Copy
            </button>
            <button class="btn btn-warning btn-sm">
              <i class="fas fa-eye"></i> Column Visibility
            </button>
          </div>
        </div>
        <div class="container table-container">
        <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Karyawan</th>
            <th>Nama Lengkap</th>
            <th>Tanggal Lembur</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Jenis Lembur</th>
            <th>Gaji</th>
            <th>Jam Kerja Lembur</th>
            <th>Jam I</th>
            <th>Jam II</th>
            <th>Jam III</th>
            <th>Jam IV</th>
            <th>Upah Lembur</th>
            <th>Keterangan</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lemburRecords as $index => $lembur)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lembur->id_karyawan }}</td>
                <td>{{ $lembur->nama_lengkap }}</td>
                <td>{{ $lembur->tanggal_lembur->format('Y-m-d') }}</td>
                <td>{{ $lembur->jam_masuk->format('H:i') }}</td>
                <td>{{ $lembur->jam_keluar->format('H:i') }}</td>
                <td>{{ $lembur->jenis_lembur }}</td>
                <td>{{'Rp. ' . number_format($lembur->gaji, 0, ',', '.') }}</td>
                <td>{{ number_format($lembur->jam_kerja_lembur, 1, ',', '.') }}</td>
                <td>{{ number_format($lembur->jam_i, 1, ',', '.') }}</td>
                <td>{{ number_format($lembur->jam_ii, 1, ',', '.') }}</td>
                <td>{{ number_format($lembur->jam_iii, 1, ',', '.') }}</td>
                <td>{{ number_format($lembur->jam_iv, 1, ',', '.') }}</td>
                <td>{{ 'Rp. ' . number_format($lembur->upah_lembur, 0, ',', '.') }}
                </td>
                <td>{{ $lembur->keterangan }}</td>
                <td>
                    <button
                        class="btn btn-warning btn-sm edit-button"
                        data-id="{{ $lembur->id }}"
                    >
                        Edit
                    </button>
                    <button
                        class="btn btn-danger btn-sm delete-buttonLembur"
                        data-id="{{ $lembur->id }}"
                    >
                        Hapus
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Pagination Links -->
<div class="pagination">
    {{ $lemburRecords ->links() }}
</div>
        </div>
      </div>
    </div>
    <footer
      style="
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
      "
    >
      <p>&copy; 2024 PT. Tolan Tiga Indonesia. All rights reserved.</p>
      <div style="display: flex; justify-content: center; gap: 20px">
        <a href="#" style="text-decoration: none; color: #007bff"
          >Privacy Policy</a
        >
        <a href="#" style="text-decoration: none; color: #007bff"
          >Terms of Service</a
        >
        <a href="#" style="text-decoration: none; color: #007bff">Contact Us</a>
      </div>
    </footer>

    <!-- Modal for Adding Lembur -->
    <div id="addLemburModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeAddLemburModal">&times;</span>
        <h3 style="margin-bottom: 30px"><strong>Tambah Data Lembur</strong></h3>
        <form id="addlemburForm" method="POST" action="{{ route('store-lembur') }}">
    @csrf
    <div class="form-group">
        <label for="addIDKaryawan">ID Karyawan</label>
        <input type="text" class="form-control @error('IDKaryawan') is-invalid @enderror" id="addIDKaryawan" name="IDKaryawan" pattern="\d*" title="Please enter numbers only" value="{{ old('IDKaryawan') }}" required />
        @error('IDKaryawan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="namaLengkap">Nama Lengkap</label>
        <input type="text" class="form-control @error('namaLengkap') is-invalid @enderror" id="addnamaLengkap" name="namaLengkap" value="{{ old('namaLengkap') }}" required />
        @error('namaLengkap')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="addTanggalLembur">Tanggal Lembur</label>
        <input
          type="date"
          class="form-control @error('tanggalLembur') is-invalid @enderror"
          id="addtanggalLembur"
          name="tanggalLembur"
          onchange="checkDate('add')"
          value="{{ old('tanggalLembur') }}"
          required
        />
        @error('tanggalLembur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamMasuk">Jam Masuk</label>
        <input type="time" class="form-control @error('jamMasuk') is-invalid @enderror" id="addjamMasuk" name="jamMasuk" value="{{ old('jamMasuk') }}" required />
        @error('jamMasuk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamKeluar">Jam Keluar</label>
        <input type="time" class="form-control @error('jamKeluar') is-invalid @enderror" id="addjamKeluar" name="jamKeluar" value="{{ old('jamKeluar') }}" required />
        @error('jamKeluar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJenisLembur">Jenis Lembur</label>
        <select class="form-control @error('jenisLembur') is-invalid @enderror" id="addjenisLembur" name="jenisLembur" required>
          <option value="" selected readOnly>Hari Biasa</option>
          <option value="Hari Biasa" {{ old('jenisLembur') == 'Hari Biasa' ? 'selected' : '' }}>Hari Biasa</option>
          <option value="Weekend" {{ old('jenisLembur') == 'Weekend' ? 'selected' : '' }}>Weekend</option>
          <option value="Libur" {{ old('jenisLembur') == 'Libur' ? 'selected' : '' }}>Libur</option>
        </select>
        @error('jenisLembur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addGaji">Gaji (Rp)</label>
        <input type="text" class="form-control @error('gaji') is-invalid @enderror" id="addgaji" name="gaji" value="{{ old('gaji') }}" required />
        @error('gaji')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamKerjaLembur">Total Waktu Kerja</label>
        <input type="number" class="form-control @error('jamKerjaLembur') is-invalid @enderror" id="addjamKerjaLembur" name="jamKerjaLembur" value="{{ old('jamKerjaLembur') }}" readOnly />
        @error('jamKerjaLembur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamI">Jam I</label>
        <input type="number" class="form-control @error('jamI') is-invalid @enderror" id="addjamI" name="jamI" value="{{ old('jamI') }}" readOnly />
        @error('jamI')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamII">Jam II</label>
        <input type="number" class="form-control @error('jamII') is-invalid @enderror" id="addjamII" name="jamII" value="{{ old('jamII') }}" readOnly />
        @error('jamII')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamIII">Jam III</label>
        <input type="number" class="form-control @error('jamIII') is-invalid @enderror" id="addjamIII" name="jamIII" value="{{ old('jamIII') }}" readOnly />
        @error('jamIII')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addJamIV">Jam IV</label>
        <input type="number" class="form-control @error('jamIV') is-invalid @enderror" id="addjamIV" name="jamIV" value="{{ old('jamIV') }}" readOnly />
        @error('jamIV')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addTotalJamLembur">Total Jam Lembur</label>
        <input type="number" class="form-control @error('totalJamLembur') is-invalid @enderror" id="addtotalJamLembur" name="totalJamLembur" value="{{ old('totalJamLembur') }}" readOnly />
        @error('totalJamLembur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addUpahLembur">Upah Lembur (Rp)</label>
        <input type="number" class="form-control @error('upahLembur') is-invalid @enderror" id="addupahLembur" name="upahLembur" value="{{ old('upahLembur') }}" readOnly />
        @error('upahLembur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="addKeterangan">Keterangan</label>
        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="addKeterangan" name="keterangan">{{ old('keterangan') }}</textarea>
        @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
      </div>
    </div>

    <!-- Modal for Editing Lembur -->
    <div id="editLemburModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeEditLemburModal">&times;</span>
        <h3 style="margin-bottom: 30px"><strong>Edit Data Lembur</strong></h3>
        <form id="editlemburForm">
        <div class="form-group">
            <label for="editIDKaryawan">ID Karyawan</label>
            <input
              type="text"
              class="form-control"
              id="editIDKaryawan"
              pattern="\d*"
              title="Please enter numbers only"
              required
            />
            <div id="editIDKaryawanError" style="display: none; color: red">
              ID Karyawan should contain numbers only.
            </div>
          </div>
          <div class="form-group">
            <label for="namaLengkap">Nama Lengkap</label>
            <input
              type="text"
              class="form-control"
              id="editnamaLengkap"
              required
            />
          </div>
          <div class="form-group">
            <label for="editTanggalLembur">Tanggal Lembur</label>
            <input
              type="date"
              class="form-control"
              id="edittanggalLembur"
              onchange="checkDate('edit')"
              required
            />
          </div>
          <div class="form-group">
            <label for="editJamMasuk">Jam Masuk</label>
            <input
              type="time"
              class="form-control"
              id="editjamMasuk"
              required
            />
          </div>
          <div class="form-group">
            <label for="editJamKeluar">Jam Keluar</label>
            <input
              type="time"
              class="form-control"
              id="editjamKeluar"
              required
            />
          </div>
          <div class="form-group">
            <label for="editJenisLembur">Jenis Lembur</label>
            <select class="form-control" id="editjenisLembur" required>
              <option value="" selected readOnly></option>
              <option value="Hari Biasa">Hari Biasa</option>
              <option value="Weekend">Weekend</option>
              <option value="Libur">Libur</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editGaji">Gaji (Rp)</label>
            <input type="text" class="form-control" id="editgaji" required />
          </div>
          <div class="form-group">
            <label for="editJamKerjaLembur">Total Waktu Kerja</label>
            <input
              type="number"
              class="form-control"
              id="editjamKerjaLembur"
              readOnly
            />
          </div>
          <div class="form-group">
            <label for="editJamI">Jam I</label>
            <input type="number" class="form-control" id="editjamI" readOnly />
          </div>
          <div class="form-group">
            <label for="editJamII">Jam II</label>
            <input type="number" class="form-control" id="editjamII" readOnly />
          </div>
          <div class="form-group">
            <label for="editJamIII">Jam III</label>
            <input
              type="number"
              class="form-control"
              id="editjamIII"
              readOnly
            />
          </div>
          <div class="form-group">
            <label for="editJamIV">Jam IV</label>
            <input type="number" class="form-control" id="editjamIV" readOnly />
          </div>
          <div class="form-group">
            <label for="editTotal Jam Lembur">Total Jam Lembur</label>
            <input
              type="number"
              class="form-control"
              id="edittotalJamLembur"
              readOnly
            />
          </div>
          <div class="form-group">
            <label for="editUpahLembur">Upah Lembur (Rp)</label>
            <input
              type="number"
              class="form-control"
              id="editupahLembur"
              readOnly
            />
          </div>
          <div class="form-group">
            <label for="editKeterangan">Keterangan</label>
            <textarea class="form-control" id="editKeterangan"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>

    <!-- Modal for Deleting Data -->
    <div id="deleteLemburModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeDeleteLemburModal">&times;</span>
        <h3 style="margin-bottom: 30px">
          <strong>Hapus Data Lembur</strong>
        </h3>
        <p>Apakah Anda yakin ingin menghapus data lembur ini?</p>
        <form id="deleteLemburForm">
          <input type="hidden" id="deleteLemburID" name="deleteLemburID" />
          <button type="submit" class="btn btn-danger">Hapus</button>
          <button
            type="button"
            class="btn btn-secondary"
            id="cancelLemburDelete"
          >
            Batal
          </button>
        </form>
      </div>
    </div>
    <script>
 // Get modal elements
 var addModal = document.getElementById("addLemburModal");
    var editModal = document.getElementById("editLemburModal");
    var deleteModal = document.getElementById("deleteLemburModal");

    // Get open modal buttons
    var addBtn = document.getElementById("tambahDataLembur");
    var editButtons = document.getElementsByClassName("edit-button");
    var deleteButtons = document.getElementsByClassName("delete-buttonLembur");

    // Get close buttons
    var closeAddModal = document.getElementById("closeAddLemburModal");
    var closeEditModal = document.getElementById("closeEditLemburModal");
    var closeDeleteModal = document.getElementById("closeDeleteLemburModal");
    var cancelDelete = document.getElementById("cancelLemburDelete");

    // Function to open Add Lembur Modal
    function openAddModal() {
        addModal.style.display = "block";
    }

    // Function to close Add Lembur Modal
    function closeAddModalFunc() {
        addModal.style.display = "none";
    }

    // Function to open Edit Lembur Modal
    function openEditModal() {
        editModal.style.display = "block";
    }

    // Function to close Edit Lembur Modal
    function closeEditModalFunc() {
        editModal.style.display = "none";
    }

    // Function to open Delete Lembur Modal
    function openDeleteModal() {
        var employeeID = this.closest("tr").querySelector("td:nth-child(3)").innerText;
        document.getElementById("deleteLemburID").value = employeeID;
        deleteModal.style.display = "block";
    }

    // Function to close Delete Lembur Modal
    function closeDeleteModalFunc() {
        deleteModal.style.display = "none";
    }

    // Listen for open click for Add Lembur Modal
    addBtn.addEventListener("click", openAddModal);

    // Listen for open click for Edit Lembur Modal
    Array.from(editButtons).forEach(function (button) {
        button.addEventListener("click", openEditModal);
    });

    // Listen for open click for Delete Lembur Modal
    Array.from(deleteButtons).forEach(function (button) {
        button.addEventListener("click", openDeleteModal);
    });

    // Listen for close click for Add Lembur Modal
    closeAddModal.addEventListener("click", closeAddModalFunc);

    // Listen for close click for Edit Lembur Modal
    closeEditModal.addEventListener("click", closeEditModalFunc);

    // Listen for close click for Delete Lembur Modal
    closeDeleteModal.addEventListener("click", closeDeleteModalFunc);
    cancelDelete.addEventListener("click", closeDeleteModalFunc);


  // Function to close modal if outside click
  function outsideClick(e) {
    if (e.target === addModal) {
        closeAddModalFunc();
    } else if (e.target === editModal) {
        closeEditModalFunc();
    } else if (e.target === deleteModal) {
        closeDeleteModalFunc();
    }
}



    // Event listener for outside click
    window.addEventListener("click", outsideClick);
     // Add Lembur Modal

// Determine if a date is a weekend
function isAddWeekend(date) {
  var day = new Date(date).getDay();
  return day === 0 || day === 6;
}

// Set default times based on date and jenisLembur
function setAddDefaultTimes(date) {
  var jamMasuk = document.getElementById("addjamMasuk");
  var jamKeluar = document.getElementById("addjamKeluar");
  var jenisLembur = document.getElementById("addjenisLembur").value;

  if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
    jamMasuk.value = "";
    jamKeluar.value = "";
    jamMasuk.readOnly = false;
    jamKeluar.readOnly = false;
  } else if (jenisLembur === "Hari Biasa") {
    jamMasuk.value = "07:30";
    jamMasuk.readOnly = true;
    jamKeluar.value = "";
    jamKeluar.readOnly = false;
  }
}
document
  .getElementById("addjenisLembur")
  .addEventListener("change", function () {
    var date = document.getElementById("addtanggalLembur").value;
    setAddDefaultTimes(date);
  });

// Calculate time difference in hours
function calculateAddTimeDifference(start, end) {
  var startTime = new Date("1970-01-01T" + start + ":00Z");
  var endTime = new Date("1970-01-01T" + end + ":00Z");
  return (endTime - startTime) / 1000 / 60 / 60;
}

// Round hours to the nearest 0.5
function roundAddToHalfHour(value) {
  return Math.round(value * 2) / 2;
}

// Update addjamKerjaLembur based on addjamKeluar
function updateAddJamKerjaLembur() {
  var tanggalLembur = document.getElementById("addtanggalLembur").value;
  var jamMasuk = document.getElementById("addjamMasuk").value;
  var jamKeluar = document.getElementById("addjamKeluar").value;
  var jamKerjaLembur = document.getElementById("addjamKerjaLembur");
  var jenisLembur = document.getElementById("addjenisLembur").value;

  if (!tanggalLembur || !jamKeluar) {
    jamKerjaLembur.value = "";
    calculateAddTotalJamLembur();
    return;
  }

  if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
    if (jamMasuk && jamKeluar) {
      var difference = calculateAddTimeDifference(jamMasuk, jamKeluar);
      jamKerjaLembur.value = roundAddToHalfHour(difference).toFixed(1);
    } else {
      jamKerjaLembur.value = "";
    }
  } else {
    var dayOfWeek = new Date(tanggalLembur).getDay();
    var endOfDay = dayOfWeek === 5 ? "15:30" : "16:30";
    var difference = calculateAddTimeDifference(endOfDay, jamKeluar);
    jamKerjaLembur.value = roundAddToHalfHour(difference).toFixed(1);
  }

  updateAddJamCategories();
}

// Update jamI, jamII, jamIII, and jamIV based on jenisLembur
function updateAddJamCategories() {
  var jenisLembur = document.getElementById("addjenisLembur").value;
  var jamKerjaLembur =
    parseFloat(document.getElementById("addjamKerjaLembur").value) || 0;

  var jamI = document.getElementById("addjamI");
  var jamII = document.getElementById("addjamII");
  var jamIII = document.getElementById("addjamIII");
  var jamIV = document.getElementById("addjamIV");

  jamI.value = "";
  jamII.value = "";
  jamIII.value = "";
  jamIV.value = "";

  if (jenisLembur === "Hari Biasa") {
    if (jamKerjaLembur > 0) {
      jamI.value = Math.min(jamKerjaLembur, 1).toFixed(1);
      jamII.value = (
        jamKerjaLembur > 1 ? jamKerjaLembur - 1 : ""
      ).toFixed(1);
    }
  } else if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
    if (jamKerjaLembur > 0) {
      jamII.value = Math.min(jamKerjaLembur, 8).toFixed(1);
      jamIII.value =
        jamKerjaLembur > 8
          ? Math.min(jamKerjaLembur - 8, 1).toFixed(1)
          : "";
      jamIV.value =
        jamKerjaLembur > 9 ? (jamKerjaLembur - 9).toFixed(1) : "";
    }
  }

  calculateAddTotalJamLembur();
}

function calculateAddTotalJamLembur() {
  var jamI = parseFloat(document.getElementById("addjamI").value) || 0;
  var jamII = parseFloat(document.getElementById("addjamII").value) || 0;
  var jamIII =
    parseFloat(document.getElementById("addjamIII").value) || 0;
  var jamIV = parseFloat(document.getElementById("addjamIV").value) || 0;

  var totalJamLembur = jamI * 1.5 + jamII * 2 + jamIII * 3 + jamIV * 4;
  document.getElementById("addtotalJamLembur").value =
    totalJamLembur.toFixed(1);
}


 // Function to calculate addupahLembur
 function addcalculateUpahLembur() {
        var gaji =
          parseFloat(
            document.getElementById("addgaji").value.replace(/[^0-9]/g, "")
          ) || 0;
        var totalJamLembur =
          parseFloat(document.getElementById("addtotalJamLembur").value) || 0;
        var hourlyWage = gaji / 173;
        hourlyWage = Math.round(hourlyWage);
        var upahLembur = hourlyWage * totalJamLembur;
        document.getElementById("addupahLembur").value = upahLembur
          .toFixed(0);

      }

      // Function to calculate addupahLembur
 function editcalculateUpahLembur() {
        var gaji =
          parseFloat(
            document.getElementById("editgaji").value.replace(/[^0-9]/g, "")
          ) || 0;
        var totalJamLembur =
          parseFloat(document.getElementById("edittotalJamLembur").value) || 0;
        var hourlyWage = gaji / 173;
        hourlyWage = Math.round(hourlyWage);
        var upahLembur = hourlyWage * totalJamLembur;
        document.getElementById("editupahLembur").value = upahLembur
          .toFixed(0);

      }


// Event listeners for Add Lembur Modal
document
  .getElementById("addjamKeluar")
  .addEventListener("change", addcalculateUpahLembur);
  document
  .getElementById("editjamKeluar")
  .addEventListener("change", editcalculateUpahLembur);
document
  .getElementById("addgaji")
  .addEventListener("change", addcalculateUpahLembur);
  document
  .getElementById("editgaji")
  .addEventListener("change", editcalculateUpahLembur);
document
  .getElementById("addjenisLembur")
  .addEventListener("change", updateAddJamCategories);
document
  .getElementById("addjamKerjaLembur")
  .addEventListener("input", updateAddJamCategories);
document
  .getElementById("addjamKeluar")
  .addEventListener("change", updateAddJamKerjaLembur);
document
  .getElementById("addjamI")
  .addEventListener("input", calculateAddTotalJamLembur);
document
  .getElementById("addjamII")
  .addEventListener("input", calculateAddTotalJamLembur);
document
  .getElementById("addjamIII")
  .addEventListener("input", calculateAddTotalJamLembur);
document
  .getElementById("addjamIV")
  .addEventListener("input", calculateAddTotalJamLembur);
document
  .getElementById("addtanggalLembur")
  .addEventListener("change", function (e) {
    var date = e.target.value;
    var jenisLembur = document.getElementById("addjenisLembur");

    jenisLembur.value = isAddWeekend(date)
      ? "Weekend" || "Libur"
      : "Hari Biasa";
    setAddDefaultTimes(date);
  });
document
  .getElementById("addjenisLembur")
  .addEventListener("change", function () {
    updateAddJamCategories();

    if (
      document.getElementById("addjenisLembur").value === "Weekend" ||
      document.getElementById("addjenisLembur").value === "Libur"
    ) {
      document.getElementById("addjamMasuk").value = "";
      document.getElementById("addjamKeluar").value = "";
      document.getElementById("addjamMasuk").readOnly = false;
    } else {
      document.getElementById("addjamMasuk").value = "07:30";
      document.getElementById("addjamKeluar").readOnly = false;
    }
  });
// Edit Lembur Modal
// Handle input for editIDKaryawan field
document
  .getElementById("editIDKaryawan")
  .addEventListener("input", function (e) {
    var value = e.target.value;
    var isValid = /^\d*$/.test(value);
    document.getElementById("editIDKaryawanError").style.display = isValid
      ? "none"
      : "block";
    e.target.value = value.replace(/\D/g, "");
  });

// Determine if a date is a weekend
function isEditWeekend(date) {
  var day = new Date(date).getDay();
  return day === 0 || day === 6;
}

// Set default times based on date and jenisLembur
function setEditDefaultTimes(date) {
  var jamMasuk = document.getElementById("editjamMasuk");
  var jamKeluar = document.getElementById("editjamKeluar");
  var jenisLembur = document.getElementById("editjenisLembur").value;

  if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
    jamMasuk.value = "";
    jamKeluar.value = "";
    jamMasuk.readOnly = false;
    jamKeluar.readOnly = false;
  } else if (jenisLembur === "Hari Biasa") {
    jamMasuk.value = "07:30";
    jamMasuk.readOnly = true;
    jamKeluar.value = "";
    jamKeluar.readOnly = false;
  }
}

document
  .getElementById("editjenisLembur")
  .addEventListener("change", function () {
    var date = document.getElementById("edittanggalLembur").value;
    setEditDefaultTimes(date);
  });

// Calculate time difference in hours
function calculateEditTimeDifference(start, end) {
  var startTime = new Date("1970-01-01T" + start + ":00Z");
  var endTime = new Date("1970-01-01T" + end + ":00Z");
  return (endTime - startTime) / 1000 / 60 / 60;
}

// Round hours to the nearest 0.5
function roundEditToHalfHour(value) {
  return Math.round(value * 2) / 2;
}

// Update editjamKerjaLembur based on editjamKeluar
function updateEditJamKerjaLembur() {
  var tanggalLembur = document.getElementById("edittanggalLembur").value;
  var jamMasuk = document.getElementById("editjamMasuk").value;
  var jamKeluar = document.getElementById("editjamKeluar").value;
  var jamKerjaLembur = document.getElementById("editjamKerjaLembur");
  var jenisLembur = document.getElementById("editjenisLembur").value;

  if (!tanggalLembur || !jamKeluar) {
    jamKerjaLembur.value = "";
    calculateEditTotalJamLembur();
    return;
  }

  if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
    if (jamMasuk && jamKeluar) {
      var difference = calculateEditTimeDifference(jamMasuk, jamKeluar);
      jamKerjaLembur.value = roundEditToHalfHour(difference).toFixed(1);
    } else {
      jamKerjaLembur.value = "";
    }
  } else {
    var dayOfWeek = new Date(tanggalLembur).getDay();
    var endOfDay = dayOfWeek === 5 ? "15:30" : "16:30";
    var difference = calculateEditTimeDifference(endOfDay, jamKeluar);
    jamKerjaLembur.value = roundEditToHalfHour(difference).toFixed(1);
  }

  updateEditJamCategories();
}

// Update jamI, jamII, jamIII, and jamIV based on jenisLembur
function updateEditJamCategories() {
  var jenisLembur = document.getElementById("editjenisLembur").value;
  var jamKerjaLembur =
    parseFloat(document.getElementById("editjamKerjaLembur").value) || 0;

  var jamI = document.getElementById("editjamI");
  var jamII = document.getElementById("editjamII");
  var jamIII = document.getElementById("editjamIII");
  var jamIV = document.getElementById("editjamIV");

  jamI.value = "";
  jamII.value = "";
  jamIII.value = "";
  jamIV.value = "";

  if (jenisLembur === "Hari Biasa") {
    if (jamKerjaLembur > 0) {
      jamI.value = Math.min(jamKerjaLembur, 1).toFixed(1);
      jamII.value = (
        jamKerjaLembur > 1 ? jamKerjaLembur - 1 : ""
      ).toFixed(1);
    }
  } else if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
    if (jamKerjaLembur > 0) {
      jamII.value = Math.min(jamKerjaLembur, 8).toFixed(1);
      jamIII.value =
        jamKerjaLembur > 8
          ? Math.min(jamKerjaLembur - 8, 1).toFixed(1)
          : "";
      jamIV.value =
        jamKerjaLembur > 9 ? (jamKerjaLembur - 9).toFixed(1) : "";
    }
  }

  calculateEditTotalJamLembur();
}

function calculateEditTotalJamLembur() {
  var jamI = parseFloat(document.getElementById("editjamI").value) || 0;
  var jamII = parseFloat(document.getElementById("editjamII").value) || 0;
  var jamIII =
    parseFloat(document.getElementById("editjamIII").value) || 0;
  var jamIV = parseFloat(document.getElementById("editjamIV").value) || 0;

  var totalJamLembur = jamI * 1.5 + jamII * 2 + jamIII * 3 + jamIV * 4;
  document.getElementById("edittotalJamLembur").value =
    totalJamLembur.toFixed(1);
}

// Event listeners for Edit Lembur Modal
document
  .getElementById("editjenisLembur")
  .addEventListener("change", updateEditJamCategories);
document
  .getElementById("editjamKerjaLembur")
  .addEventListener("input", updateEditJamCategories);
document
  .getElementById("editjamKeluar")
  .addEventListener("change", updateEditJamKerjaLembur);
document
  .getElementById("editjamI")
  .addEventListener("input", calculateEditTotalJamLembur);
document
  .getElementById("editjamII")
  .addEventListener("input", calculateEditTotalJamLembur);
document
  .getElementById("editjamIII")
  .addEventListener("input", calculateEditTotalJamLembur);
document
  .getElementById("editjamIV")
  .addEventListener("input", calculateEditTotalJamLembur);
document
  .getElementById("edittanggalLembur")
  .addEventListener("change", function (e) {
    var date = e.target.value;
    var jenisLembur = document.getElementById("editjenisLembur");

    jenisLembur.value = isEditWeekend(date)
      ? "Weekend" || "Libur"
      : "Hari Biasa";
    setEditDefaultTimes(date);
  });
document
  .getElementById("editjenisLembur")
  .addEventListener("change", function () {
    updateEditJamCategories();

    if (
      document.getElementById("editjenisLembur").value === "Weekend" ||
      document.getElementById("editjenisLembur").value === "Libur"
    ) {
      document.getElementById("editjamMasuk").value = "";
      document.getElementById("editjamKeluar").value = "";
      document.getElementById("editjamMasuk").readOnly = false;
    } else {
      document.getElementById("editjamMasuk").value = "07:30";
      document.getElementById("editjamMasuk").readOnly = true;
    }
  });    

      //Batas Delete Lembur Modal

      function checkDate(prefix) {
        var dateField = document.getElementById(prefix + "tanggalLembur");
        var jenisLemburField = document.getElementById(prefix + "jenisLembur");

        var selectedDate = new Date(dateField.value);
        var dayOfWeek = selectedDate.getDay(); // 0 (Sunday) to 6 (Saturday)

        var weekendOption = jenisLemburField.querySelector(
          'option[value="Weekend"]'
        );
        var hariBiasaOption = jenisLemburField.querySelector(
          'option[value="Hari Biasa"]'
        );
        var liburOption = jenisLemburField.querySelector(
          'option[value="Libur"]'
        );

        if (dayOfWeek === 0 || dayOfWeek === 6) {
          // Weekend
          weekendOption.readOnly = false;
          hariBiasaOption.readOnly = true;
          liburOption.readOnly = false;
        } else {
          // Weekday
          weekendOption.readOnly = true;
          hariBiasaOption.readOnly = false;
          liburOption.readOnly = false;
          // If currently selected value is 'Weekend', change it to 'Hari Biasa'
          if (jenisLemburField.value === "Weekend") {
            jenisLemburField.value = "Hari Biasa";
          }
        }
      }
    </script>
  </body>
</html>

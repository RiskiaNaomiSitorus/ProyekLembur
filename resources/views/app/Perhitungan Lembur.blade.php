<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Perhitungan Lembur</title>
    <link rel="stylesheet" href="{{ assets ('assets/styles.css')}}" />
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
            <a href="Dashboard.html"><i class="fas fa-home"></i>Dashboard</a>
          </li>
          <li>
            <a href="Data Karyawan.html"
              ><i class="fas fa-user"></i>Data Karyawan</a
            >
          </li>
          <li>
            <a href="Rekapitulasi Jam Lembur.html"
              ><i class="fas fa-project-diagram"></i>Rekapitulasi Jam Lembur</a
            >
          </li>
          <li>
            <a href="Perhitungan Lembur.html"
              ><i class="fas fa-address-book"></i>Perhitungan Lembur</a
            >
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
                Riskia Sitorus <i class="fa fa-caret-down"></i>
              </div>
              <div class="dropdown-content">
                <a href="settings.html">Settings</a>
                <a href="javascript:void(0);" onclick="logout();">Logout</a>
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
                <th>Nama Lengkap</th>
                <th>ID Karyawan</th>
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
                <th>Upah Lembur (Rp)</th>
                <th>Keterangan</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>12345</td>
                <td>2024-07-18</td>
                <td>08:00</td>
                <td>17:00</td>
                <td>Hari Biasa</td>
                <td>5,000,000</td>
                <td>8</td>
                <td>1</td>
                <td>7</td>
                <td>0</td>
                <td>0</td>
                <td>600,000</td>
                <td>-</td>
                <td>
                  <button
                    id="edit-buttonLembur"
                    class="btn btn-warning btn-sm edit-button"
                  >
                    Edit
                  </button>
                  <button class="btn btn-danger btn-sm delete-buttonLembur">
                    Hapus
                  </button>
                </td>
              </tr>
              <!-- Additional rows as needed -->
            </tbody>
          </table>
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
        <form id="addlemburForm">
          <div class="form-group">
            <label for="namaLengkap">Nama Lengkap</label>
            <input
              type="text"
              class="form-control"
              id="addnamaLengkap"
              required
            />
          </div>
          <div class="form-group">
            <label for="addIDKaryawan">ID Karyawan</label>
            <input
              type="text"
              class="form-control"
              id="addIDKaryawan"
              pattern="\d*"
              title="Please enter numbers only"
              required
            />
            <div id="addIDKaryawanError" style="display: none; color: red">
              ID Karyawan should contain numbers only.
            </div>
          </div>
          <div class="form-group">
            <label for="addTanggalLembur">Tanggal Lembur</label>
            <input
              type="date"
              class="form-control"
              id="addtanggalLembur"
              onchange="checkDate('add')"
              required
            />
          </div>
          <div class="form-group">
            <label for="addJamMasuk">Jam Masuk</label>
            <input type="time" class="form-control" id="addjamMasuk" required />
          </div>
          <div class="form-group">
            <label for="addJamKeluar">Jam Keluar</label>
            <input
              type="time"
              class="form-control"
              id="addjamKeluar"
              required
            />
          </div>
          <div class="form-group">
            <label for="addJenisLembur">Jenis Lembur</label>
            <select class="form-control" id="addjenisLembur" required>
              <option value="" selected disabled>Hari Biasa</option>
              <option value="Hari Biasa">Hari Biasa</option>
              <option value="Weekend">Weekend</option>
              <option value="Libur">Libur</option>
            </select>
          </div>
          <div class="form-group">
            <label for="addGaji">Gaji</label>
            <input type="text" class="form-control" id="addgaji" required />
          </div>
          <div class="form-group">
            <label for="addJamKerjaLembur">Total Waktu Kerja</label>
            <input
              type="number"
              class="form-control"
              id="addjamKerjaLembur"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="addJamI">Jam I</label>
            <input type="number" class="form-control" id="addjamI" disabled />
          </div>
          <div class="form-group">
            <label for="addJamII">Jam II</label>
            <input type="number" class="form-control" id="addjamII" disabled />
          </div>
          <div class="form-group">
            <label for="addJamIII">Jam III</label>
            <input type="number" class="form-control" id="addjamIII" disabled />
          </div>
          <div class="form-group">
            <label for="addJamIV">Jam IV</label>
            <input type="number" class="form-control" id="addjamIV" disabled />
          </div>
          <div class="form-group">
            <label for="addTotal Jam Lembur">Total Jam Lembur</label>
            <input
              type="number"
              class="form-control"
              id="addtotalJamLembur"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="addUpahLembur">Upah Lembur (Rp)</label>
            <input
              type="number"
              class="form-control"
              id="addupahLembur"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="addKeterangan">Keterangan</label>
            <textarea class="form-control" id="addKeterangan"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>

    <!-- Modal for Editing Lembur -->
    <div id="editLemburModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeEditLemburModal">&times;</span>
        <h3 style="margin-bottom: 30px"><strong>Tambah Data Lembur</strong></h3>
        <form id="editlemburForm">
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
              <option value="" selected disabled></option>
              <option value="Hari Biasa">Hari Biasa</option>
              <option value="Weekend">Weekend</option>
              <option value="Libur">Libur</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editGaji">Gaji</label>
            <input type="text" class="form-control" id="editgaji" required />
          </div>
          <div class="form-group">
            <label for="editJamKerjaLembur">Total Waktu Kerja</label>
            <input
              type="number"
              class="form-control"
              id="editjamKerjaLembur"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="editJamI">Jam I</label>
            <input type="number" class="form-control" id="editjamI" disabled />
          </div>
          <div class="form-group">
            <label for="editJamII">Jam II</label>
            <input type="number" class="form-control" id="editjamII" disabled />
          </div>
          <div class="form-group">
            <label for="editJamIII">Jam III</label>
            <input
              type="number"
              class="form-control"
              id="editjamIII"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="editJamIV">Jam IV</label>
            <input type="number" class="form-control" id="editjamIV" disabled />
          </div>
          <div class="form-group">
            <label for="editTotal Jam Lembur">Total Jam Lembur</label>
            <input
              type="number"
              class="form-control"
              id="edittotalJamLembur"
              disabled
            />
          </div>
          <div class="form-group">
            <label for="editUpahLembur">Upah Lembur (Rp)</label>
            <input
              type="number"
              class="form-control"
              id="editupahLembur"
              disabled
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
      //Batas Add Lembur Modal
      // Modal handling
      var modal = document.getElementById("addLemburModal");
      var btn = document.getElementById("tambahDataLembur");
      var span = document.getElementById("closeAddLemburModal");

      btn.onclick = function () {
        modal.style.display = "block";
      };

      span.onclick = function () {
        modal.style.display = "none";
      };

      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };

      // Format numbers as Rupiah
      function formatRupiah(angka) {
        angka = angka.replace(/[^,\d]/g, "").toString();
        var split = angka.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
          var separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return "Rp " + rupiah;
      }

      // Handle input for addgaji field
      document
        .getElementById("addgaji")
        .addEventListener("input", function (e) {
          var value = e.target.value.replace(/\D/g, "");
          e.target.value = formatRupiah(value);
        });

      // Handle input for addIDKaryawan field
      document
        .getElementById("addIDKaryawan")
        .addEventListener("input", function (e) {
          var value = e.target.value;
          var isValid = /^\d*$/.test(value);
          document.getElementById("addIDKaryawanError").style.display = isValid
            ? "none"
            : "block";
          e.target.value = value.replace(/\D/g, "");
        });

      // Determine if a date is a weekend
      function isWeekend(date) {
        var day = new Date(date).getDay();
        return day === 0 || day === 6;
      }

      // Set default times based on date and jenisLembur
      function setDefaultTimes(date) {
        var dayOfWeek = new Date(date).getDay();
        var jamMasuk = document.getElementById("addjamMasuk");
        var jamKeluar = document.getElementById("addjamKeluar");
        var jenisLembur = document.getElementById("addjenisLembur").value;

        if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
          jamMasuk.value = "";
          jamKeluar.value = "";
          jamMasuk.disabled = false;
          jamKeluar.disabled = false;
        } else if (jenisLembur === "Hari Biasa") {
          jamMasuk.value = "07:30";
          jamMasuk.disabled = true;
          jamKeluar.value = "";
          jamKeluar.disabled = false;
        }
      }

      document
        .getElementById("addjenisLembur")
        .addEventListener("change", function () {
          var date = document.getElementById("addtanggalLembur").value;
          setDefaultTimes(date);
        });

      // Calculate time difference in hours
      function calculateTimeDifference(start, end) {
        var startTime = new Date("1970-01-01T" + start + ":00Z");
        var endTime = new Date("1970-01-01T" + end + ":00Z");
        return (endTime - startTime) / 1000 / 60 / 60;
      }

      // Round hours to the nearest 0.5
      function roundToHalfHour(value) {
        return Math.round(value * 2) / 2;
      }

      // Update addjamKerjaLembur based on addjamKeluar
      function updateJamKerjaLembur() {
        var tanggalLembur = document.getElementById("addtanggalLembur").value;
        var jamMasuk = document.getElementById("addjamMasuk").value;
        var jamKeluar = document.getElementById("addjamKeluar").value;
        var jamKerjaLembur = document.getElementById("addjamKerjaLembur");
        var jenisLembur = document.getElementById("addjenisLembur").value;

        if (!tanggalLembur || !jamKeluar) {
          jamKerjaLembur.value = "";
          calculateTotalJamLembur();
          return;
        }

        if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
          if (jamMasuk && jamKeluar) {
            var difference = calculateTimeDifference(jamMasuk, jamKeluar);
            jamKerjaLembur.value = roundToHalfHour(difference).toFixed(1);
          } else {
            jamKerjaLembur.value = "";
          }
        } else {
          var dayOfWeek = new Date(tanggalLembur).getDay();
          var endOfDay = dayOfWeek === 5 ? "15:30" : "16:30";
          var difference = calculateTimeDifference(endOfDay, jamKeluar);
          jamKerjaLembur.value = roundToHalfHour(difference).toFixed(1);
        }

        updateJamCategories();
      }

      // Update jamI, jamII, jamIII, and jamIV based on jenisLembur
      function updateJamCategories() {
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

        calculateTotalJamLembur();
      }

      function calculateTotalJamLembur() {
        var jamI = parseFloat(document.getElementById("addjamI").value) || 0;
        var jamII = parseFloat(document.getElementById("addjamII").value) || 0;
        var jamIII =
          parseFloat(document.getElementById("addjamIII").value) || 0;
        var jamIV = parseFloat(document.getElementById("addjamIV").value) || 0;

        var totalJamLembur = jamI * 1.5 + jamII * 2 + jamIII * 3 + jamIV * 4;
        document.getElementById("addtotalJamLembur").value =
          totalJamLembur.toFixed(1);
      }

      // Event listeners
      document
        .getElementById("addjenisLembur")
        .addEventListener("change", updateJamCategories);
      document
        .getElementById("addjamKerjaLembur")
        .addEventListener("input", updateJamCategories);
      document
        .getElementById("addjamKeluar")
        .addEventListener("change", updateJamKerjaLembur);
      document
        .getElementById("addjamI")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("addjamII")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("addjamIII")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("addjamIV")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("addtanggalLembur")
        .addEventListener("change", function (e) {
          var date = e.target.value;
          var jenisLembur = document.getElementById("addjenisLembur");

          jenisLembur.value = isWeekend(date)
            ? "Weekend" || "Libur"
            : "Hari Biasa";
          setDefaultTimes(date);
        });
      document
        .getElementById("addjenisLembur")
        .addEventListener("change", function () {
          updateJamCategories();

          if (
            document.getElementById("addjenisLembur").value === "Weekend" ||
            document.getElementById("addjenisLembur").value === "Libur"
          ) {
            document.getElementById("addjamMasuk").value = "";
            document.getElementById("addjamKeluar").value = "";
            document.getElementById("addjamMasuk").disabled = false;
            document.getElementById("addjamKeluar").disabled = false;
          }
        });

      // Function to calculate addupahLembur
      function calculateUpahLembur() {
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
          .toFixed(0)
          .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format as Rupiah
      }

      // Update function to recalculate upah lembur
      function updateUpahLembur() {
        calculateUpahLembur();
      }

      // Event listeners to trigger upah lembur calculation
      document
        .getElementById("addgaji")
        .addEventListener("input", updateUpahLembur);
      document
        .getElementById("addtotalJamLembur")
        .addEventListener("input", updateUpahLembur);
      document.addEventListener("DOMContentLoaded", updateUpahLembur);
      //Batas Add Lembur Modal

      //Batas edit Lembur Modal
      // Modal handling
      var modal = document.getElementById("editLemburModal");
      var btn = document.getElementById("edit-buttonLembur");
      var span = document.getElementById("closeEditLemburModal");

      btn.onclick = function () {
        modal.style.display = "block";
      };

      span.onclick = function () {
        modal.style.display = "none";
      };

      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };

      // Format numbers as Rupiah
      function formatRupiah(angka) {
        angka = angka.replace(/[^,\d]/g, "").toString();
        var split = angka.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
          var separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return "Rp " + rupiah;
      }

      // Handle input for editgaji field
      document
        .getElementById("editgaji")
        .addEventListener("input", function (e) {
          var value = e.target.value.replace(/\D/g, "");
          e.target.value = formatRupiah(value);
        });

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
      function isWeekend(date) {
        var day = new Date(date).getDay();
        return day === 0 || day === 6;
      }

      // Set default times based on date and jenisLembur
      function setDefaultTimes(date) {
        var dayOfWeek = new Date(date).getDay();
        var jamMasuk = document.getElementById("editjamMasuk");
        var jamKeluar = document.getElementById("editjamKeluar");
        var jenisLembur = document.getElementById("editjenisLembur").value;

        if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
          jamMasuk.value = "";
          jamKeluar.value = "";
          jamMasuk.disabled = false;
          jamKeluar.disabled = false;
        } else if (jenisLembur === "Hari Biasa") {
          jamMasuk.value = "07:30";
          jamMasuk.disabled = true;
          jamKeluar.value = "";
          jamKeluar.disabled = false;
        }
      }

      document
        .getElementById("editjenisLembur")
        .addEventListener("change", function () {
          var date = document.getElementById("edittanggalLembur").value;
          setDefaultTimes(date);
        });

      // Calculate time difference in hours
      function calculateTimeDifference(start, end) {
        var startTime = new Date("1970-01-01T" + start + ":00Z");
        var endTime = new Date("1970-01-01T" + end + ":00Z");
        return (endTime - startTime) / 1000 / 60 / 60;
      }

      // Round hours to the nearest 0.5
      function roundToHalfHour(value) {
        return Math.round(value * 2) / 2;
      }

      // Update addjamKerjaLembur based on addjamKeluar
      function updateJamKerjaLembur() {
        var tanggalLembur = document.getElementById("edittanggalLembur").value;
        var jamMasuk = document.getElementById("editjamMasuk").value;
        var jamKeluar = document.getElementById("editjamKeluar").value;
        var jamKerjaLembur = document.getElementById("editjamKerjaLembur");
        var jenisLembur = document.getElementById("editjenisLembur").value;

        if (!tanggalLembur || !jamKeluar) {
          jamKerjaLembur.value = "";
          calculateTotalJamLembur();
          return;
        }

        if (jenisLembur === "Weekend" || jenisLembur === "Libur") {
          if (jamMasuk && jamKeluar) {
            var difference = calculateTimeDifference(jamMasuk, jamKeluar);
            jamKerjaLembur.value = roundToHalfHour(difference).toFixed(1);
          } else {
            jamKerjaLembur.value = "";
          }
        } else {
          var dayOfWeek = new Date(tanggalLembur).getDay();
          var endOfDay = dayOfWeek === 5 ? "15:30" : "16:30";
          var difference = calculateTimeDifference(endOfDay, jamKeluar);
          jamKerjaLembur.value = roundToHalfHour(difference).toFixed(1);
        }

        updateJamCategories();
      }

      // Update jamI, jamII, jamIII, and jamIV based on jenisLembur
      function updateJamCategories() {
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

        calculateTotalJamLembur();
      }

      function calculateTotalJamLembur() {
        var jamI = parseFloat(document.getElementById("editjamI").value) || 0;
        var jamII = parseFloat(document.getElementById("editjamII").value) || 0;
        var jamIII =
          parseFloat(document.getElementById("editjamIII").value) || 0;
        var jamIV = parseFloat(document.getElementById("editjamIV").value) || 0;

        var totalJamLembur = jamI * 1.5 + jamII * 2 + jamIII * 3 + jamIV * 4;
        document.getElementById("edittotalJamLembur").value =
          totalJamLembur.toFixed(1);
      }

      // Event listeners
      document
        .getElementById("editjenisLembur")
        .addEventListener("change", updateJamCategories);
      document
        .getElementById("editjamKerjaLembur")
        .addEventListener("input", updateJamCategories);
      document
        .getElementById("editjamKeluar")
        .addEventListener("change", updateJamKerjaLembur);
      document
        .getElementById("editjamI")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("editjamII")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("editjamIII")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("editjamIV")
        .addEventListener("input", calculateTotalJamLembur);
      document
        .getElementById("edittanggalLembur")
        .addEventListener("change", function (e) {
          var date = e.target.value;
          var jenisLembur = document.getElementById("editjenisLembur");

          jenisLembur.value = isWeekend(date)
            ? "Weekend" || "Libur"
            : "Hari Biasa";
          setDefaultTimes(date);
        });
      document
        .getElementById("editjenisLembur")
        .addEventListener("change", function () {
          updateJamCategories();

          if (
            document.getElementById("editjenisLembur").value === "Weekend" ||
            document.getElementById("editjenisLembur").value === "Libur"
          ) {
            document.getElementById("editjamMasuk").value = "";
            document.getElementById("editjamKeluar").value = "";
            document.getElementById("editjamMasuk").disabled = false;
            document.getElementById("editjamKeluar").disabled = false;
          }
        });

      // Function to calculate editupahLembur
      function calculateUpahLembur() {
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
          .toFixed(0)
          .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format as Rupiah
      }

      // Update function to recalculate upah lembur
      function updateUpahLembur() {
        calculateUpahLembur();
      }

      // Event listeners to trigger upah lembur calculation
      document
        .getElementById("editgaji")
        .addEventListener("input", updateUpahLembur);
      document
        .getElementById("edittotalJamLembur")
        .addEventListener("input", updateUpahLembur);
      document.addEventListener("DOMContentLoaded", updateUpahLembur);
      //Batas Edit Lembur Modal

      //Batas Delete Lembur Modal
      //Batas Delete Lembur Modal
      var deleteModal = document.getElementById("deleteLemburModal");
      var deleteButtons = document.getElementsByClassName(
        "delete-buttonLembur"
      );
      var closeDeleteModal = document.getElementById("closeDeleteLemburModal");
      var cancelDelete = document.getElementById("cancelLemburDelete");

      // Listen for open click for delete modal
      Array.from(deleteButtons).forEach(function (button) {
        button.addEventListener("click", openDeleteModal);
      });

      closeDeleteModal.addEventListener("click", closeDeleteModalFunc);
      cancelDelete.addEventListener("click", closeDeleteModalFunc);

      // Function to open delete modal
      function openDeleteModal() {
        var employeeID =
          this.closest("tr").querySelector("td:nth-child(3)").innerText;
        document.getElementById("deleteLemburID").value = employeeID;
        deleteModal.style.display = "block";
      }

      // Function to close delete modal
      function closeDeleteModalFunc() {
        deleteModal.style.display = "none";
      }

      // Function to close modal if outside click
      function outsideClick(e) {
        if (e.target == deleteModal) {
          deleteModal.style.display = "none";
        }
      }

      // Event listener for outside click
      window.addEventListener("click", outsideClick);

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
          weekendOption.disabled = false;
          hariBiasaOption.disabled = true;
          liburOption.disabled = false;
        } else {
          // Weekday
          weekendOption.disabled = true;
          hariBiasaOption.disabled = false;
          liburOption.disabled = false;
          // If currently selected value is 'Weekend', change it to 'Hari Biasa'
          if (jenisLemburField.value === "Weekend") {
            jenisLemburField.value = "Hari Biasa";
          }
        }
      }

      // Logout function
      function logout() {
        alert("You have logged out successfully.");
        window.location.href = "login.html";
      }
    </script>
  </body>
</html>

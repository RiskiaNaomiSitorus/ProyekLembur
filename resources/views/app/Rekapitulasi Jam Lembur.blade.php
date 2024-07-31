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
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
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
                Riskia Sitorus <i class="fa fa-caret-down"></i>
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
          <div class="date"><h5>12 Juli 2024</h5></div>
        </div>
        <div class="dashboard"></div>
        <div class="header-section">
          <div class="container"><h1>Summary Lembur Karyawan</h1></div>

          <div class="form-container">
            <form id="overtime-form">
              <div class="form-group">
                <label for="nama">Nama:</label>
                <input
                  type="text"
                  id="nama"
                  name="nama"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label for="in">In:</label>
                <input
                  type="datetime-local"
                  id="in"
                  name="in"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label for="out">Out:</label>
                <input
                  type="datetime-local"
                  id="out"
                  name="out"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <input
                  type="text"
                  id="keterangan"
                  name="keterangan"
                  class="form-control"
                  required
                />
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>

          <div class="table-container">
            <table
              class="table table-striped table-bordered"
              id="overtime-table"
            >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jumlah Jam</th>
                  <th>Rp</th>
                </tr>
              </thead>
              <tbody id="summary-table">
                <!-- Rows will be inserted here by JavaScript -->
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2">Total</td>
                  <td id="total-jam" class="bold">0</td>
                  <td id="total-upah" class="bold">0</td>
                </tr>
              </tfoot>
            </table>
          </div>

          <p>Alamat: Jalan Example No.123, Jakarta</p>
          <p>Tanggal: 12 Juli 2024</p>
          <p>Approved by: Manager Name</p>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function () {
        $("#overtime-table").DataTable({
          dom: "Bfrtip",
          buttons: [
            {
              extend: "excelHtml5",
              text: '<i class="fas fa-file-excel"></i> Excel',
              className: "btn btn-primary btn-sm",
            },
            {
              extend: "csvHtml5",
              text: '<i class="fas fa-file-csv"></i> CSV',
              className: "btn btn-csv btn-sm",
            },
            {
              extend: "copyHtml5",
              text: '<i class="fas fa-copy"></i> Copy',
              className: "btn btn-copy btn-sm",
            },
            {
              extend: "colvis",
              text: '<i class="fas fa-eye"></i> Column Visibility',
              className: "btn btn-colvis btn-sm",
            },
            {
              extend: "print",
              text: '<i class="fas fa-print"></i> Print',
              className: "btn btn-print btn-sm",
              customize: function (win) {
                $(win.document.body).css("font-size", "10pt");
                $(win.document.body)
                  .find("table")
                  .addClass("compact")
                  .css("font-size", "inherit");
              },
            },
          ],
        });
      });

      // Data lembur
      const overtimeData = [];

      // Function untuk menghitung lembur
      function calculateOvertime(inTime, outTime) {
        const inDate = new Date(inTime);
        const outDate = new Date(outTime);
        const diff = outDate - inDate;
        const totalHours = diff / 1000 / 60 / 60;

        const jam1 = Math.min(totalHours, 1);
        const jam2 = totalHours > 1 ? Math.min(totalHours - 1, 1) : 0;
        const jam9 = totalHours > 2 ? Math.min(totalHours - 2, 1) : 0;
        const jam10 = totalHours > 3 ? totalHours - 3 : 0;

        const totalLembur = jam1 + jam2 + jam9 + jam10;
        const upahLembur =
          (jam1 * 1.5 + jam2 * 2 + jam9 * 3 + jam10 * 4) * 21803;

        return { totalLembur, upahLembur };
      }

      // Function untuk mengisi tabel
      function populateSummaryTable(data) {
        const tableBody = document.getElementById("summary-table");
        tableBody.innerHTML = ""; // Clear existing rows
        let totalJam = 0;
        let totalUpah = 0;

        data.forEach((item, index) => {
          const row = document.createElement("tr");

          const cellNo = document.createElement("td");
          cellNo.textContent = index + 1;
          row.appendChild(cellNo);

          const cellNama = document.createElement("td");
          cellNama.textContent = item.nama;
          row.appendChild(cellNama);

          const cellJam = document.createElement("td");
          cellJam.textContent = item.totalLembur.toFixed(2);
          row.appendChild(cellJam);

          const cellRp = document.createElement("td");
          cellRp.textContent = item.upahLembur.toFixed(2);
          row.appendChild(cellRp);

          tableBody.appendChild(row);

          totalJam += item.totalLembur;
          totalUpah += item.upahLembur;
        });

        document.getElementById("total-jam").textContent = totalJam.toFixed(2);
        document.getElementById("total-upah").textContent =
          totalUpah.toFixed(2);
      }

      // Function untuk menangani submit form
      document
        .getElementById("overtime-form")
        .addEventListener("submit", function (event) {
          event.preventDefault();

          const formData = new FormData(event.target);
          const data = Object.fromEntries(formData.entries());

          const { totalLembur, upahLembur } = calculateOvertime(
            data.in,
            data.out
          );

          const newOvertime = {
            nama: data.nama,
            totalLembur: totalLembur,
            upahLembur: upahLembur,
            keterangan: data.keterangan,
          };

          overtimeData.push(newOvertime);
          populateSummaryTable(overtimeData);
          event.target.reset();
        });

      // Function untuk mengonversi tabel ke file Excel
      function exportToExcel() {
        const table = document.getElementById("overtime-table");
        const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
        XLSX.utils.book_append_sheet(
          wb,
          XLSX.utils.table_to_sheet(table),
          "Sheet1"
        );

        // Membuat Total row menjadi bold
        const ws = wb.Sheets["Sheet1"];
        const range = XLSX.utils.decode_range(ws["!ref"]);
        const totalRow = range.e.r;

        for (let C = range.s.c; C <= range.e.c; ++C) {
          const cellAddress = XLSX.utils.encode_cell({ r: totalRow, c: C });
          if (!ws[cellAddress]) continue;
          ws[cellAddress].s = {
            font: { bold: true },
          };
        }

        XLSX.writeFile(wb, "Summary_Lembur.xlsx");
      }

      // Populate table on page load
      document.addEventListener("DOMContentLoaded", () => {
        populateSummaryTable(overtimeData);
      });
    </script>
  </body>
</html>

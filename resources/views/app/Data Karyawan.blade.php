<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Data Karyawan</title>
    <link rel="stylesheet" href="{{ asset ('assets/styles.css')}}" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    />
    <style>
      html,
      body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
      }
      .wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
      }
      .main_content {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 20px;
        margin-left: 220px; /* Adjust the margin to account for the sidebar */
      }
      .sidebar {
        position: fixed;
        height: 100%;
        width: 220px;
        background-color: #f8f9fa;
        padding-top: 20px;
      }
      .header {
        width: 100%;
        background-color: #f8f9fa;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .header-section {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 20px;
      }
      .card-header {
        margin: 20px;
        border: 1px solid #11a634;
        border-radius: 0; /* Menghapus border-radius untuk membuat persegi */
        box-shadow: 0 2px 4px rgba(0, 255, 38, 0.1);
        width: 245px; /* Menentukan lebar card */
        height: 40px;
        background-color: #1bbc53;
        color: white;
        display: flex;
        align-items: center; /* Menambahkan padding untuk header */
      }
      .card-header i {
        margin-right: 10px;
      }
      .card-header h4 {
        margin-left: 10px;
        margin: 0;
        flex-shrink: 0;
      }
      .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        margin-left: 20px;
      }
      .table-container {
        width: 100%;
        margin-left: 5px;
      }
      .table-container table {
        width: 100%;
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
      .logout-button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
      }
      .logout-button:hover {
        background-color: #c82333;
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
          <div class="date">
            <h5>12 Juli 2024</h5>
          </div>
        </div>
        <div class="dashboard">
          <h2>Data Karyawan</h2>
        </div>
        <div class="header-section">
          <div class="card-header" id="tambahDataKaryawan">
            <i></i>
            <i class="fas fa-plus-circle"></i>
            <h4>Tambah Data Karyawan</h4>
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
            <th>Nama Karyawan</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Gaji</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($karyawan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->id_karyawan }}</td>
            <td>{{ $item->nama_karyawan }}</td>
            <td>{{ $item->jenis_kelamin }}</td>
            <td>{{ $item->jabatan }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ 'Rp. ' . number_format($item->gaji, 0, ',', '.') }}</td>
            <td>
                <button class="btn btn-warning btn-sm edit-button">
                    Edit
                </button>
                <button class="btn btn-danger btn-sm delete-button">
                    Hapus
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="pagination">
    {{ $karyawan->links() }}
</div>
        </div>
      <!-- Modal for Editing Data -->
    <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3 style="margin-bottom: 30px">
          <strong>Edit Data Karyawan</strong>
        </h3>
        <form id="editForm">
          <div class="form-group">
            <label for="editID">ID Karyawan</label>
            <input
              type="text"
              class="form-control"
              id="editID"
              name="editID"
              required
            />
            <div id="editIDKaryawanError" style="display: none; color: red">
              ID Karyawan should contain numbers only.
            </div>
          </div>
          <div class="form-group">
            <label for="editName">Nama Karyawan</label>
            <input
              type="text"
              class="form-control"
              id="editName"
              name="editName"
              required
            />
          </div>
          <div class="form-group">
            <label for="editGender">Jenis Kelamin</label>
            <select
              class="form-control"
              id="editGender"
              name="editGender"
              required
            >
              <option value="" selected disabled></option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editPosition">Jabatan</label>
            <input
              type="text"
              class="form-control"
              id="editPosition"
              name="editPosition"
              required
            />
          </div>
          <div class="form-group">
            <label for="editStatus">Status</label>
            <select
              class="form-control"
              id="editStatus"
              name="editStatus"
              required
            >
              <option value="" selected disabled></option>
              <option value="Laki-laki">Aktif</option>
              <option value="Perempuan">Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editSalary">Gaji</label>
            <input
              type="text"
              class="form-control"
              id="editSalary"
              name="editSalary"
              required
            />
          </div>        
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
    <!-- Modal for Deleting Data -->
    <div id="deleteModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeDeleteModal">&times;</span>
        <h3 style="margin-bottom: 30px">
          <strong>Hapus Data Karyawan</strong>
        </h3>
        <p>Apakah Anda yakin ingin menghapus data karyawan ini?</p>
        <form id="deleteForm">
          <input type="hidden" id="deleteID" name="deleteID" />
          <button type="submit" class="btn btn-danger">Hapus</button>
          <button type="button" class="btn btn-secondary" id="cancelDelete">
            Batal
          </button>
        </form>
      </div>
    </div>

    <!-- Modal for Adding Data -->
    <div id="addModal" class="modal">
      <div class="modal-content">
        <span class="close" id="closeAddModal">&times;</span>
        <h3 style="margin-bottom: 30px">
          <strong>Tambah Data Karyawan</strong>
        </h3>

        <form id="addForm">
          <div class="form-group">
            <label for="addID">ID Karyawan</label>
            <input
              type="text"
              class="form-control"
              id="addID"
              name="addID"
              required
            />
            <div id="addIDKaryawanError" style="display: none; color: red">
              ID Karyawan should contain numbers only.
            </div>
          </div>
          <div class="form-group">
            <label for="addName">Nama Karyawan</label>
            <input
              type="text"
              class="form-control"
              id="addName"
              name="addName"
              required
            />
          </div>
          <div class="form-group">
            <label for="addGender">Jenis Kelamin</label>
            <select
              class="form-control"
              id="addGender"
              name="addGender"
              required
            >
              <option value="" selected disabled></option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="addPosition">Jabatan</label>
            <input
              type="text"
              class="form-control"
              id="addPosition"
              name="addPosition"
              required
            />
          </div>
            <div class="form-group">
              <label for="addStatus">Status</label>
              <select
                class="form-control"
                id="addStatus"
                name="addStatus"
                required
              >
                <option value="" selected disabled></option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
          </div>
          <div class="form-group">
            <label for="addSalary">Gaji</label>
            <input
              type="text"
              class="form-control"
              id="addSalary"
              name="addSalary"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary">Add Karyawan</button>
        </form>
      </div>
    </div>
        <script>

       // Get modal elements
       var editmodal = document.getElementById("editModal");
      var addModal = document.getElementById("addModal");
      var deleteModal = document.getElementById("deleteModal");

      // Get open modal buttons
      var editButtons = document.getElementsByClassName("edit-button");
      var tambahDataKaryawan = document.getElementById("tambahDataKaryawan");
      var deleteButtons = document.getElementsByClassName("delete-button");

      // Get close buttons
      var closeModal = document.getElementById("closeModal");
      var closeAddModal = document.getElementById("closeAddModal");
      var closeDeleteModal = document.getElementById("closeDeleteModal");
      var cancelDelete = document.getElementById("cancelDelete");

      // Listen for open click for edit modal
      Array.from(editButtons).forEach(function (button) {
        button.addEventListener("click", openEditModal);
      });

      // Listen for open click for add modal
      tambahDataKaryawan.addEventListener("click", openAddModal);

      // Listen for open click for delete modal
      Array.from(deleteButtons).forEach(function (button) {
        button.addEventListener("click", openDeleteModal);
      });

      // Listen for close click
      closeModal.addEventListener("click", closeEditModal);
      closeAddModal.addEventListener("click", closeAddModalFunc);
      closeDeleteModal.addEventListener("click", closeDeleteModalFunc);
      cancelDelete.addEventListener("click", closeDeleteModalFunc);

      // Outside click
      window.addEventListener("click", outsideClick);

      // Function to open edit modal
      function openEditModal() {
        editmodal.style.display = "block";
      }

      // Function to open add modal
      function openAddModal() {
        addModal.style.display = "block";
      }

      // Function to open delete modal
      function openDeleteModal() {
        var employeeID =
          this.closest("tr").querySelector("td:nth-child(2)").innerText;
        document.getElementById("deleteID").value = employeeID;
        deleteModal.style.display = "block";
      }

      // Function to close edit modal
      function closeEditModal() {
        editmodal.style.display = "none";
      }

      // Function to close add modal
      function closeAddModalFunc() {
        addModal.style.display = "none";
      }

      // Function to close delete modal
      function closeDeleteModalFunc() {
        deleteModal.style.display = "none";
      }

      // Function to close modal if outside click
      function outsideClick(e) {
        if (e.target == modal) {
          editmodal.style.display = "none";
        }
        if (e.target == addModal) {
          addModal.style.display = "none";
        }
        if (e.target == deleteModal) {
          deleteModal.style.display = "none";
        }
      }

      // Event listener for changes in gaji
      document
        .getElementById("editSalary")
        .addEventListener("input", function (e) {
          let value = e.target.value.replace(/[^,\d]/g, "");
          let formattedValue = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
          }).format(value);
          e.target.value = formattedValue.replace("IDR", "Rp").trim();

          // Recalculate upahLembur when gaji changes
          calculateUpahLembur();
        });
      // Event listener for changes in gaji
      document
        .getElementById("addSalary")
        .addEventListener("input", function (e) {
          let value = e.target.value.replace(/[^,\d]/g, "");
          let formattedValue = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
          }).format(value);
          e.target.value = formattedValue.replace("IDR", "Rp").trim();

          // Recalculate upahLembur when gaji changes
          calculateUpahLembur();
        });

        document
        .getElementById("addID")
        .addEventListener("input", function (e) {
          var value = e.target.value;
          var isValid = /^\d*$/.test(value);
          document.getElementById("addIDKaryawanError").style.display = isValid
            ? "none"
            : "block";
          e.target.value = value.replace(/\D/g, "");
        });

        document
        .getElementById("editID")
        .addEventListener("input", function (e) {
          var value = e.target.value;
          var isValid = /^\d*$/.test(value);
          document.getElementById("editIDKaryawanError").style.display = isValid
            ? "none"
            : "block";
          e.target.value = value.replace(/\D/g, "");
        });
    </script>
    <!-- Modal HTML -->
    <div id="detailModal" class="modal">
      <div class="modal-content">
        <span class="close-button">&times;</span>
        <h3 id="modalTitle"></h3>
        <div id="modalBody"></div>
      </div>
    </div>
  </body>
</html>

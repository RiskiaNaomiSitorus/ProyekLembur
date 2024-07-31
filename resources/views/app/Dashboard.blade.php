<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF token here -->
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link
      rel="stylesheet"
      href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
    />
    <style>
      /* Modal Styles */
      .modal {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
      }
      .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
      }
      .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      .close-button:hover,
      .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }

      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #f8f9fa;
      }
      .title {
        font-size: 24px;
        font-weight: bold;
      }
      .user-info {
        display: flex;
        align-items: center;
      }
      .user-info .username {
        margin-right: 15px;
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
        <div class="dashboard-title">Dashboard</div>
        <div class="cards-container">
          <div class="card card-karyawan">
            <h3>Data Karyawan</h3>
            <div class="data-content">
              <p>20</p>
              <i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="label-container">
              <div class="label">Karyawan Aktif</div>
            </div>
          </div>
          <div class="card card-absen">
            <h3>Data Absen</h3>
            <div class="data-content">
              <p>15</p>
              <i class="glyphicon glyphicon-list-alt"></i>
            </div>
            <div class="label-container">
              <div class="label">Absen Hari Ini</div>
            </div>
          </div>
          <div class="card card-lembur">
            <div class="data-content">
              <p id="currentTime" class="time"></p>
              <p id="currentDate" class="date"></p>
            </div>
            <div class="label-container">
              <div class="label">Waktu Saat Ini</div>
            </div>
          </div>
        </div>
        <div class="charts-wrapper">
          <div class="chart-container">
            <canvas id="myChart"></canvas>
          </div>
          <div class="report-container">
            <h3>Laporan Lembur</h3>
            <ul>
              <li>
                <span>Per Minggu</span>
                <a
                  href="#"
                  class="view-details"
                  data-title="Laporan Per Minggu"
                  data-content="Details for Laporan Per Minggu."
                  >View Details</a
                >
              </li>
              <li>
                <span>Per Bulan</span>
                <a
                  href="#"
                  class="view-details"
                  data-title="Laporan Per Bulan"
                  data-content="Details for Laporan Per Bulan."
                  >View Details</a
                >
              </li>
              <li>
                <span>Per Tahun</span>
                <a
                  href="#"
                  class="view-details"
                  data-title="Laporan Per Tahun"
                  data-content="Details for Laporan Per Tahun."
                  >View Details</a
                >
              </li>
            </ul>
            <!-- Calendar Container -->
            <div class="calendar-container" id="calendar"></div>
          </div>
        </div>
        <footer>
          <p>&copy; 2024 PT. Tolan Tiga Indonesia. All rights reserved.</p>
          <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Contact Us</a>
          </div>
        </footer>
      </div>
    </div>
  <script>
 $(document).ready(function() {
  // Initialize datepicker
  $("#datepicker").datepicker();
  $("#calendar").datepicker();

  // Toggle kalender dropdown
  $("#calendarButton").on("click", function() {
    $("#calendar").toggle();
  });

  // Set current time and date in WIB
  function updateTime() {
    var now = new Date();
    var optionsTime = { 
      timeZone: 'Asia/Jakarta', 
      hour: '2-digit', 
      minute: '2-digit',
    };
    var optionsDate = { 
      timeZone: 'Asia/Jakarta', 
      day: '2-digit', 
      month: '2-digit', 
      year: 'numeric'
    };
    var formatterTime = new Intl.DateTimeFormat('id-ID', optionsTime);
    var formatterDate = new Intl.DateTimeFormat('id-ID', optionsDate);
    var formattedTime = formatterTime.format(now);
    var formattedDate = formatterDate.format(now);
    $("#currentTime").text(formattedTime);
    $("#currentDate").text(formattedDate);
  }

  updateTime();
  setInterval(updateTime, 60000); // Update time every minute

  // Chart.js code
  const ctx = document.getElementById("myChart").getContext("2d");
  const myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
      ],
      datasets: [
        {
          label: "Lembur",
          data: [65, 59, 80, 81, 56, 55, 40],
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  var ctxLembur = document.getElementById('lemburChart').getContext('2d');
  var lemburChart = new Chart(ctxLembur, {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: 'Total Jam Lembur',
        data: [30, 45, 60, 40, 50, 55, 70, 65, 60, 75, 80, 90], // contoh data lembur per bulan
        backgroundColor: 'rgba(0, 123, 255, 0.5)',
        borderColor: 'rgba(0, 123, 255, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Modal script
  const modal = document.querySelector(".modal");
  const span = document.getElementsByClassName("close-button")[0];

  document.querySelectorAll(".view-details").forEach((link) => {
    link.onclick = function () {
      const title = this.getAttribute("data-title");
      const content = this.getAttribute("data-content");
      document.querySelector(".modal-content h2").textContent = title;
      document.querySelector(".modal-content p").textContent = content;
      modal.style.display = "block";
    };
  });

  span.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
});

</script>

  </body>
</html>

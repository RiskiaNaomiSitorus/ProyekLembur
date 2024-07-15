var lemburCtx = document.getElementById('lemburChart').getContext('2d');
var lemburChart = new Chart(lemburCtx, {
  type: 'bar',
  data: {
    labels: ['Karyawan A', 'Karyawan B', 'Karyawan C', 'Karyawan D', 'Karyawan E'],
    datasets: [{
      label: 'Jam Lembur',
      data: [12, 19, 3, 5, 2],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)'
      ],
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

var statusCtx = document.getElementById('statusChart').getContext('2d');
var statusChart = new Chart(statusCtx, {
  type: 'pie',
  data: {
    labels: ['Aktif', 'Lembur'],
    datasets: [{
      label: 'Status Karyawan',
      data: [15, 5],
      backgroundColor: [
        'rgba(75, 192, 192, 0.2)',
        'rgba(255, 99, 132, 0.2)'
      ],
      borderColor: [
        'rgba(75, 192, 192, 1)',
        'rgba(255, 99, 132, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      tooltip: {
        enabled: true
      }
    }
  }
});

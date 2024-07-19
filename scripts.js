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

// perhitungan
document.addEventListener('DOMContentLoaded', () => {
  const upahPerBulan = 5190000;
  const upahPerJam = upahPerBulan / 173;

  const totalLemburHariKerja = 24;
  const totalLemburHariLibur = 42;
  const totalLembur = totalLemburHariKerja + totalLemburHariLibur;

  const totalUpahLembur = totalLembur * upahPerJam;

  console.log(`Upah per jam: Rp. ${upahPerJam}`);
  console.log(`Total upah lembur: Rp. ${totalUpahLembur}`);
});


// rekapitulasi
document.getElementById('overtime-form').addEventListener('submit', function(event) {
  event.preventDefault();
  
  const day = document.getElementById('day').value;
  const date = document.getElementById('date').value;
  const inTime = document.getElementById('in-time').value;
  const outTime = document.getElementById('out-time').value;
  const notes = document.getElementById('notes').value;
  
  const totalHours = calculateTotalHours(inTime, outTime);
  const overtime = calculateOvertime(totalHours);
  
  const newRow = `
      <tr>
          <td></td>
          <td>${day}</td>
          <td>${date}</td>
          <td>${inTime}</td>
          <td>${outTime}</td>
          <td>${totalHours}</td>
          <td>${overtime.jamI}</td>
          <td>${overtime.jamII}</td>
          <td>${overtime.jamIX}</td>
          <td>${overtime.jamX}</td>
          <td>${overtime.totalOvertimeHours}</td>
          <td>${overtime.totalOvertimePay}</td>
          <td>${notes}</td>
      </tr>
  `;
  
  document.getElementById('overtime-table').insertAdjacentHTML('beforeend', newRow);
  updateRowNumbers();
  this.reset();
});

function calculateTotalHours(inTime, outTime) {
  const [inHours, inMinutes] = inTime.split(':').map(Number);
  const [outHours, outMinutes] = outTime.split(':').map(Number);
  
  const totalInMinutes = (inHours * 60) + inMinutes;
  const totalOutMinutes = (outHours * 60) + outMinutes;
  
  return (totalOutMinutes - totalInMinutes) / 60;
}

function calculateOvertime(totalHours) {
  const overtimePayPerHour = 21803;
  
  let jamI = 0, jamII = 0, jamIX = 0, jamX = 0;
  
  if (totalHours > 8) {
      const overtimeHours = totalHours - 8;
      if (overtimeHours > 4) {
          jamX = overtimeHours - 4;
          jamIX = 4;
      } else {
          jamIX = overtimeHours;
      }
      jamII = 1;
      jamI = 1.5;
  }
  
  const totalOvertimeHours = jamI + jamII + jamIX + jamX;
  const totalOvertimePay = (jamI * 1.5 + jamII * 2 + jamIX * 3 + jamX * 4) * overtimePayPerHour;
  
  return { jamI, jamII, jamIX, jamX, totalOvertimeHours, totalOvertimePay };
}

function updateRowNumbers() {
  const rows = document.querySelectorAll('#overtime-table tr');
  rows.forEach((row, index) => {
      row.cells[0].textContent = index + 1;
  });
}





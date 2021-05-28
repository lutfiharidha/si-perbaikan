@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <canvas id="myChart"></canvas>

    </div>
</div>
@endsection
@section('script')
    <script>
        var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Pengaduan", "Diterima", "Diproses", "Ditolak", "Selesai"],
    datasets: [{
      label: 'Total',
      data: [{{ $pengaduan }}, {{ $diterima }}, {{ $diproses }}, {{ $ditolak }}, {{ $siap }}],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',

      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      xAxes: [{
        ticks: {
            autoSkip: false,
            maxRotation: 0,
            minRotation: 0
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
    </script>
@endsection
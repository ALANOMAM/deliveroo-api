@extends('layouts.app')

@section('content')


<div class="container col-9 py-5">

  <h1 class="py-2 mb-3">Statistiche del tuo ristorante</h1>


  <!--inizio parte importata-->
  <div>
    <canvas id="myChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

  <script>
    //cambio l'oggetto degli ordini da php a js poi li leggo
    let orders_in_js_encoded = '<?php echo json_encode($orders); ?>';
    let orders_in_js_decoded = JSON.parse(orders_in_js_encoded);
    console.log(orders_in_js_decoded);

    const ctx = document.getElementById('myChart');
    /* const data = [
       { month: 'Gennaio', count: 10 },
       { month: 'Febbraio', count: 20 },
        { month: 'Marzo', count: 15 },
       { month: 'Aprile', count: 40 },
        { month: 'Maggio', count: 5 },
                 ];*/

    const data = [];
    const month_names = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    // Inizializza un array con zero per ogni mese
    let monthlyData = new Array(12).fill(0);

    // Popola l'array con i dati esistenti
    orders_in_js_decoded.forEach(order => {
      if (order.month_number >= 1 && order.month_number <= 12) {
        monthlyData[order.month_number - 1] = order.money_per_month;
      }
    });

    // Crea l'array di dati per il grafico
    monthlyData.forEach((cash_in, index) => {
      data.push({
        month: month_names[index + 1],
        cash_in: cash_in
      });
    });

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.map(row => row.month),
        datasets: [{
          label: 'Ammontare mensile',
          data: data.map(row => row.cash_in),
          fill: true,
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
          ],
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
  </script>

  <!--fine parte importata-->



</div>

@endsection
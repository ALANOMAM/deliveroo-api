@extends('layouts.app')

@section('content')

  {{-- HTML CON I 2 GRAFICI --}}

  <div class="container col-9 py-5">

    <h1 class="py-2 mb-4">Statistiche del tuo ristorante</h1>

    <div class="row">

        <div class="col-12 mb-5 m-auto">
          <h2 class="fs-4 text-center">Ammontare delle vendite in € per mese</h2>
          <canvas id="myChart"></canvas>
        </div>

        <div class="col-12 m-auto">
          <h2 class="fs-4 text-center">Ammontare degli ordini per mese</h2>
          <canvas id="myChart-two"></canvas>
        </div>
  
    </div>

  </div>

  {{-- SCRIPT PER PRIMO GRAFICO 

  Ammontare delle vendite in € per mese --}}
  
  <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    
  
  <script>

    //cambio l'oggetto degli ordini da php a js poi li leggo
    let orders_in_js_encoded = '<?php echo json_encode($orders); ?>';
    let orders_in_js_decoded = JSON.parse(orders_in_js_encoded);
    //console.log(orders_in_js_decoded);

    const ctx = document.getElementById('myChart');
    /* const data = [
    { month: 'Gennaio', count: 10 },
    { month: 'Febbraio', count: 20 },
      { month: 'Marzo', count: 15 },
    { month: 'Aprile', count: 40 },
      { month: 'Maggio', count: 5 },
              ];*/

    //il mio array che conterrà le componenti x e y del mio grafico          
    const data = [];
    //salvo i possibili mesi dell'anno
    const month_names = ["", "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];


    //pusho le componenti x e y del mio grafico dentro l'array
    for(let i=0; i<orders_in_js_decoded.length; i++){

      // associazione del mese in italiano e aggiunta dell'anno
      let month_name = month_names[orders_in_js_decoded[i].month_number];
      // Aggiunta dell'anno
      let year = orders_in_js_decoded[i].year; 

      // Combinazione del mese e dell'anno
      data.push({ month: month_name + ' ' + year, cash_in: orders_in_js_decoded[i].money_per_month }); 
    }
    

            
    new Chart(ctx, {
        type: 'bar',
        data: {
          //dato nell'asse delle x 
          // labels:['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'] ,
          labels: data.map(row => row.month) ,
          datasets: [{
          //nome tabella    
          label: 'Statistiche dei mesi e ammontare delle vendite' ,
          
          
          //dato nell'asse delle y 
        //data: [65, 59, 80, 81, 56, 55, 40, 100],
        data: data.map(row => row.cash_in),
        backgroundColor: 'rgba(246, 89, 0, 0.7)',  // Colore delle barre

          //riempie o no la parte sotto la linea del grafico
          fill: true,
          // Aggiunta MARIO per colore di background
          borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              // Aggiunta MARIO per simbolo Euro asse y
              ticks: {
                callback: function(value, index, values) {
                  return value + ' €';
                }
              }
            }
          }
        }
      }); 

  </script>

    {{-- SCRIPT PER SECONDO GRAFICO  

    Ammontare degli ordini per mese --}} 

  <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

  <script>

    //cambio l'oggetto degli ordini da php a js poi li leggo
    let orders_in_js_encoded2 = '<?php echo json_encode($orders2); ?>';
    let orders_in_js_decoded2 = JSON.parse(orders_in_js_encoded2);
    console.log(orders_in_js_decoded2);

    const ctx2 = document.getElementById('myChart-two');
    
    /* const data = [
    { month: 'Gennaio', count: 10 },
    { month: 'Febbraio', count: 20 },
      { month: 'Marzo', count: 15 },
    { month: 'Aprile', count: 40 },
      { month: 'Maggio', count: 5 },
              ];*/

    //il mio array che conterrà le componenti x e y del mio grafico          
    const data2 = [];
    //salvo i possibili mesi dell'anno
    const month_names2 = ["", "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];


    //pusho le componenti x e y del mio grafico dentro l'array
    for(let i=0; i<orders_in_js_decoded2.length; i++){

      // associazione del mese in italiano e aggiunta dell'anno
      let month_name = month_names2[orders_in_js_decoded2[i].month_number];
      // Aggiunta dell'anno
      let year = orders_in_js_decoded2[i].year; 

       // Combinazione del mese e dell'anno
      data2.push({ month: month_name + ' ' + year, orders_number: orders_in_js_decoded2[i].orders_per_month });
    }
    

            
  new Chart(ctx2, {
      type: 'bar',
      data: {
        //dato nell'asse delle x 
        // labels:['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'] ,
        labels: data2.map(row => row.month) ,
        datasets: [{
        //nome tabella    
        label: 'Statistiche dei mesi e numero di ordini per quel mese',
        
        //dato nell'asse delle y 
      //data: [65, 59, 80, 81, 56, 55, 40, 100],
      data: data2.map(row => row.orders_number),
      
      // Aggiunta MARIO per colore di background
      backgroundColor: 'rgba(70, 66, 85, 0.7)', 

        //riempie o no la parte sotto la linea del grafico
        fill: true,
        borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
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
  </script>

    
@endsection
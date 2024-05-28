@extends('layouts.app')

@section('content')


    <div class="container col-9 py-5">

        <h1 class="py-2 mb-3">Statistiche del tuo ristorante</h1>

    {{--@dd($orders2)--}}

 <!--inizio parte importata-->
 <a href="{{url('admin/order-stats')}}" class="nav-link link-no-active">
    <span style="color:#eb6b3e"><strong>Vai al grafico(mesi-entrata) </strong> </span>            
  </a>

 <div>
  <canvas id="myChart"></canvas>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<script>

  //cambio l'oggetto degli ordini da php a js poi li leggo
  let orders_in_js_encoded2 = '<?php echo json_encode($orders2); ?>';
  let orders_in_js_decoded2 = JSON.parse(orders_in_js_encoded2);
  console.log(orders_in_js_decoded2);

  const ctx2 = document.getElementById('myChart');
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
  const month_names2 = ["","January","February","March","April","May","June","July","August","September","October","November","December"];


  //pusho le componenti x e y del mio grafico dentro l'array
  for(let i=0; i<orders_in_js_decoded2.length; i++){
  //associo al numero del mese estratto  un nome del mese preso dall'array sopra
  let month_name = month_names2[orders_in_js_decoded2[i].month_number]
 
  if(orders_in_js_decoded2[i].month_number <= 5){
    data2.push({ month:month_name , orders_number:orders_in_js_decoded2[i].orders_per_month });
  }
      }
  console.log(data2); 

           
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

      //riempie o no la parte sotto la linea del grafico
      fill: true,
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
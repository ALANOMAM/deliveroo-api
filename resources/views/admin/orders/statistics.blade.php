@extends('layouts.app')

@section('content')


    <div class="container col-9 py-5">

        <h1 class="py-2 mb-3">Statistiche del tuo ristorante</h1>

        {{--@dd($orders)--}} 

        <!--inizio parte importata-->
        <a href="{{url('admin/order-stats2')}}" class="btn" style="background-color:#eb6b3e" >
          <span style="color:white">Vai al grafico(mesi-ordini)</span>       
          </a>

          <div>
            <canvas id="myChart"></canvas>
          </div>

        
          
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
            const month_names = ["","January","February","March","April","May","June","July","August","September","October","November","December"];
        

            //pusho le componenti x e y del mio grafico dentro l'array
            for(let i=0; i<orders_in_js_decoded.length; i++){
            //associo al numero del mese estratto  un nome del mese preso dall'array sopra
            let month_name = month_names[orders_in_js_decoded[i].month_number]
           
            data.push({ month:month_name , cash_in:orders_in_js_decoded[i].money_per_month });
                }
            console.log(data); 

                     
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

          <!--fine parte importata-->


    </div>
    
@endsection
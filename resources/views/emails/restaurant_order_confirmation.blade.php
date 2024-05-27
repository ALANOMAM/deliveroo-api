<h1>Hai ricevuto un ordine da {{$lead->customer_name}}</h1>

<p>Ecco i dettagli del tuo ordine:</p>
<ul>
    @foreach($lead->dishes as $dish)
    <li>{{ $dish->pivot->quantity }} x {{ $dish->name }} - ${{ $dish->pivot->price }}</li>
    @endforeach
</ul>
<p>Totale ordine: ${{ $lead->total_price }}</p>
<p>Da consegnare all'indirizzo: {{ $lead->customer_address }}.</p>
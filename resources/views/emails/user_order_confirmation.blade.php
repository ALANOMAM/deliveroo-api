<h1>Conferma del tuo ordine su JustBooL</h1>
<h1>Grazie per il tuo ordine, {{ $lead->customer_name }}!</h1>
<p>Ecco i dettagli del tuo ordine:</p>
<ul>
    @foreach($lead->dishes as $dish)
    <li>{{ $dish->pivot->quantity }} x {{ $dish->name }} - ${{ $dish->pivot->price }}</li>
    @endforeach
</ul>
<p>Totale ordine: ${{ $lead->total_price }}</p>
<p>Te lo consegneremo all'indirizzo: {{ $lead->customer_address }}.</p>
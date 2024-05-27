
<h1>Conferma del tuo ordine su JustBooL</h1>
<h1>Grazie per il tuo ordine, {{ $order->customer_name }}!</h1>
<p>Ecco i dettagli del tuo ordine:</p>
<ul>
    @foreach($order->dishes as $dish)
        <li>{{ $dish->pivot->quantity }} x {{ $dish->name }} - ${{ $dish->pivot->price }}</li>
    @endforeach
</ul>
<p>Totale ordine: ${{ $order->total_price }}</p>
<p>Te lo consegneremo all'indirizzo: {{ $order->customer_address }}.</p>


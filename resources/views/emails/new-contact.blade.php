<h1>
    JustBool - Nuovo Ordine da {{$lead->customer_name}} {{$lead->customer_surname}}
    <small>in data, {{$lead->created_at}}</small>
</h1>

<p>
    <ul>
        <li>
            Email utente: {{$lead->customer_email}}
        </li>
        <li>
            Telefono utente: {{$lead->customer_phone}}
        </li>
        <li>
            Indirizzo consegna: {{$lead->customer_address}}
        </li>
        <li>
            Totale ordine: {{$lead->total_price}} €
        </li>
        <li>
            Messaggio: <br>
            {{$lead->message}}
        </li>
    </ul>
</p>

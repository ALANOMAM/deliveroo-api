@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ordini del ristorante</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome cliente</th>
                <th>Cognome cliente</th>
                <th>Email cliente</th>
                <th>Telefono cliente</th>
                <th>Indirizzo cliente</th>
                <th>Prezzo totale</th>
                <th>Messaggio</th>
                <th>Data creazione</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>foreach vuoto</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
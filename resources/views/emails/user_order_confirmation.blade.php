<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine Effettuato</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .mail-body {
            max-width: 700px;
            margin: 20px auto;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(246, 89, 0, 1);
        }

        h1 {
            color: rgba(246, 89, 0, 1);
            text-align: center;
        }
        p {
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: rgba(246, 90, 0, 1);
            color: white;
            border-bottom: 2px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        h2 {
            color: rgba(246, 90, 0, 1);
            font-size: 18px;
        }
        h3 {
            color: #333;;
            font-size: 20px;
            padding-top: 20px;
        
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="mail-body">
            <h1>Grazie per il tuo ordine, {{ $lead->customer_name }}!</h1>
            <p>Ecco i dettagli del tuo ordine:</p>

            <table>
                <thead>
                    <tr>
                        <th>Piatto Ordinato</th>
                        <th>Quantità</th>
                        <th>Tot.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lead->dishes as $dish)
                        <tr>
                            <td>{{ $dish->dish_name }}</td>
                            <td>{{ $dish->pivot->quantity }}</td>
                            <td>{{ $dish->pivot->price }} €</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td>
                                
                            </td>
                            <td>
                                <h2>Totale ordine:</h2>
                            </td>
                            <td>
                                <h2>{{ $lead->total_price }} €</h2>
                            </td>
                        </tr>
                </tbody>
            </table>
            
            <h3>Te lo consegneremo all'indirizzo: {{ $lead->customer_address }}.</h3>

            <p>
                Con un click, senza stress, il tuo pasto è un success!<br>
                Il team di JustBool
            </p>

        </div>

    </div>
</body>
</html>
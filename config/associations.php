<?php

function generateDishOrderAssociations($numOrders, $numRestaurants) {

    $associations = [];
    
    // Ciclo ordini
    for ($orderId = 1; $orderId <= $numOrders; $orderId++) {

        // Seleziona un ristorante casuale
        $restaurantId = rand(1, $numRestaurants);
        
        // range dei piatti per il ristorante selezionato
        $dishStart = ($restaurantId - 1) * 5 + 1;
        $dishEnd = $dishStart + 4;
        
        // numero casuale di piatti per questo ordine
        $numDishes = rand(1, 5);
        $dishes = range($dishStart, $dishEnd);
        shuffle($dishes);
        $selectedDishes = array_slice($dishes, 0, $numDishes);
        
        
        foreach ($selectedDishes as $dishId) {
            $associations[] = [
                'dish_id' => $dishId,
                'order_id' => $orderId,
                'price' => rand(8, 20), 
                'quantity' => rand(1, 5), 
            ];
        }
    }
    
    return $associations;
}

return generateDishOrderAssociations(300, 12);
?>
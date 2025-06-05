<?php
function calcular_distancia($lat1, $lon1, $lat2, $lon2) {
    $raio = 6371; // Raio da Terra em KM

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat/2) * sin($dLat/2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon/2) * sin($dLon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));

    return $raio * $c;
}
?>

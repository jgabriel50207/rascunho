<?php
include_once 'calcular_distancia.php';

function calcular_score($distancia) {
    if ($distancia <= 5) return 100;
    if ($distancia <= 10) return 80;
    if ($distancia <= 20) return 60;
    return 50;
}
?>

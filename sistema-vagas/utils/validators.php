<?php



    @param string $uuid
    @return bool
 
function isValidUUID($uuid) {
    return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $uuid);
}


 @param string $localizacao
 @return bool

function isValidLocalizacao($localizacao) {
    return preg_match('/^[A-Z]$/', strtoupper($localizacao));
}

    @param mixed $nivel
    @return bool

function isValidNivel($nivel) {
    return is_numeric($nivel) && (int)$nivel >= 1 && (int)$nivel <= 5;
}
?>

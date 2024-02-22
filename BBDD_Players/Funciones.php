<?php 

function validarTexto($texto) {
    
    $textoRegex ='/^[A-Za-zÁÉÍÓÚáéíóúÜüÑñ]+(\s[A-Za-zÁÉÍÓÚáéíóúÜüÑñ]+)*$/';    //permite de 1 a 50 caracteres, mayusculas, minusculas, acentos, ñ , y espacios en blanco.
    
    return preg_match($textoRegex, $texto);

}

function validarDNI($dni) {
    
    $dniRegex = '/^\d{8}[A-Za-z]$/';
    
    return preg_match($dniRegex , $dni);
    
}

function validarGoles($goles){

    $golesRegex = '/^(0|[1-9]\d{1,3})$/';
    
    return preg_match($golesRegex, $goles);
    
}

?>
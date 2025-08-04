<?php

require_once __DIR__ . "/../lib/php/BAD_REQUEST.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/../lib/php/devuelveProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveErrorInterno.php";

try {

 $adivinanza = recuperaTexto("adivinanza");
 

 

 if (
  $adivinanza === false
  || $adivinanza === ""
 )
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Error Espacio en blanco",
   type: "/error/faltaresrespuesta.html"
  );

if ($adivinanza === "El metate") {
    $resultado = "{$adivinanza}  ,¡es correcto! 🎉.";
} else {
    // Si la adivinanza NO es "El metate", lanzamos la excepción
    throw new ProblemDetails(
        status: BAD_REQUEST,
        title: "Respuesta incorrecta",
        type: "/error/respuestaincorrecta.html"
    );
}
 devuelveJson($resultado);
} catch (ProblemDetails $details) {

 devuelveProblemDetails($details);
} catch (Throwable $error) {

 devuelveErrorInterno($error);
}

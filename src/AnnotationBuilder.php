<?php

namespace Koldown\HttpRoute;

use ReflectionMethod;

class AnnotationBuilder {
    
    // Métodos estáticos de la clase AnnotationBuilder
    
    /**
     * Permite crear un objeto con los parámetros que se necesitan para
     * definir una API de servicio con Laravel
     * 
     * @param ReflectionMethod $metodo Método del controlador
     * @return array Parámetros para crear API de servicio
     */
    public static function ofMethod(ReflectionMethod $metodo): array {
        // Removiendo caracteres innecesarios de la documentación
        $normalizado = str_replace([" ", "\r", "\n", "/**", "*/"], "", $metodo->getDocComment());
        
        // Depurando comentarios normalizados
        $depurado    = trim(str_replace(["*"], ";", $normalizado));
        
        // Extrayendo anotaciones encontradas en documentación
        
        $anotaciones = explode(";", substr($depurado, strpos($depurado, "#")));
        
        $resultado   = array(); // Listado de anotaciones procesadas
        
        foreach ($anotaciones as $item) {
            $posStart = strpos($item, '('); // Posición inicial de valor
            $posEnd   = strpos($item, ')'); // Posición final de valor
            
            $resultado[substr($item, 0, $posStart)] = substr($item, $posStart + 1, $posEnd - $posStart -1);
        }
        
        $resultado["#Name"] = $metodo->getName();
        
        return $resultado; // Retornando listado de anotaciones del método
    }
}
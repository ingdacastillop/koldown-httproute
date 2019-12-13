<?php

namespace Koldown\HttpRoute;

use ReflectionClass;

class AnnotationReader {
    
    // Métodos estáticos de la clase AnnotationReader
    
    /**
     * Permite realizar el escanéo de las funciones de una clase Illuminate\Routing\Controller
     * la cual por medio de mecanismos de la librería prepara un listado de API
     * 
     * @param string $class Clase Illuminate\Routing\Controller
     * @return array Listado de anotaciones para configurar API
     */
    public static function ofClass(string $class): array {
        $reflection  = new ReflectionClass($class); // Reflexión
    
        $anotaciones = []; // Métodos de la clase
    
        foreach ($reflection->getMethods() as $method) {
            if (($method->class === $class) && ($method->isPublic())) {
                array_push($anotaciones, AnnotationBuilder::ofMethod($method));
            }
        }
        
        return $anotaciones; // Retornando listado de anotaciones
    }
}
<?php

namespace Koldown\HttpRoute;

class ServicesBuilder {
    
    // Métodos estáticos de la clase ServicesBuilder
    
    /**
     * Permite crear los servicios realizando el escaneo de una clase Illuminate\Routing\Controller
     * 
     * @param string $controller Clase Illuminate\Routing\Controller
     * @return array Listado de servicios generados
     */
    public static function ofController(string $controller): array {
        $annotations = AnnotationReader::ofClass($controller);
        
        $services    = array(); // Listado de servicios
        
        foreach ($annotations as $annotation) {
            $annotation[Annotation::CONTROLLER] = $controller; // Agregando
            
            array_push($services, static::createService($annotation));
        }
        
        return $services; // Retornando listado de servicios generados
    }
    
    /**
     * Permite generar un objeto con la configuración que creará un servicio
     * 
     * @param array $annotations Parámetros del servicio
     * @return Service Servicio creación de API
     */
    private static function createService(array $annotations): Service {
        $service = new Service(); // Instanciando servicio
        
        $service->setController($annotations[Annotation::CONTROLLER]);
        $service->setRoute($annotations[Annotation::ROUTE]);
        $service->setFunction($annotations[Annotation::NAME]);
        $service->setHttpMethod($annotations[Annotation::HTTP]);
        
        return $service; // Retornando servicio configurado
    }
}
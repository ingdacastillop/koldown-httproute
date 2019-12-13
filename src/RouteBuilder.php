<?php

namespace Koldown\HttpRoute;

use Route;
use Illuminate\Routing\Route as Routing;

class RouteBuilder {
    
    // Atributos de la clase RouteBuilder
    
    /**
     *
     * @var RouteBuilder 
     */
    private static $instance;

    // Constructor de la clase RouteBuilder
    
    private function __construct() {
        
    }

    // Métodos de la clase RouteBuilder
    
    /**
     * Permite realizar el escaneo de una clase Illuminate\Routing\Controller para
     * generar los servicios API implementados en sus funciones
     * 
     * @param string $controller Clase Illuminate\Routing\Controller
     * @param array $middlewares Listado de Middlewares
     * @return void
     */
    public function readerController(string $controller, array $middlewares = null): void {
        $services = ServicesBuilder::ofController($controller);
        
        foreach ($services as $service) {
            $this->setService($service, $middlewares); // Agregando servicio
        }
    }

    /**
     * Permite cargar un servicio API en el Routing de Laravel
     * 
     * @param Service $service Servicio API
     * @param array|null $middlewares Listado de Middlewares
     * @return void
     */
    public function setService(Service $service, array $middlewares = null): void {
        $this->createRoute($service)->middleware($this->getMiddlewares($service, $middlewares));
    }

    /**
     * Permite cargar un listado de servicios API en el Routing de Laravel
     * 
     * @param array $services Listado de servicios API
     * @param array|null $middlewares Listado de Middlewares
     * @return void
     */
    public function setServices(array $services, array $middlewares = null): void {
        foreach ($services as $service) {
            if ($service instanceof Service) {
                $this->setService($service, $middlewares);
            }
        }
    }

    /**
     * Permite agregar un servicio API en el Routing de Laravel
     * 
     * @param Service $service Servicio API
     * @return Routing Ruta de API generada por Servicio
     */
    private function createRoute(Service $service): Routing {
        switch ($service->getHttpMethod()) {
            case (Methods::POST)     : return Route::post($service->getRoute(), $service->getProcess());
                
            case (Methods::GET)      : return Route::get($service->getRoute(), $service->getProcess());

            case (Methods::PUT)      : return Route::put($service->getRoute(), $service->getProcess());

            case (Methods::DELETE)   : return Route::delete($service->getRoute(), $service->getProcess());

            case (Methods::RESOURCE) : return Route::resource($service->getRoute(), $service->getProcess());
        }
    }
    
    /**
     * Permite configurar los middlewares que gestionará la ruta
     * 
     * @param Service $service Servicio API
     * @param array|null $middlewares Listado de Middlewares globales
     * @return array Listado total de middlewares
     */
    private function getMiddlewares(Service $service, array $middlewares = null): array {
        return [];
    }

    // Métodos estáticos de la clase RouteBuilder
    
    /**
     * Retorna la instancia de la clase RouteBuilder
     * 
     * @return RouteBuilder Patrón singleton
     */
    public static function getInstance(): RouteBuilder {
        if (is_null(self::$instance)) {
            self::$instance = new RouteBuilder();
        } // Generando instancia de clase
        
        return self::$instance; // Retornando instancia
    }
}
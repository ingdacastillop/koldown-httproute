<?php

namespace Koldown\HttpRoute;

class Service {
    
    // Atributos de la clase Service
    
    /**
     * Nombre del método (acción) HTTP
     * 
     * @var string 
     */
    private $httpMethod;
    
    /**
     * Enrutador del servicio
     * 
     * @var string
     */
    private $route;
    
    /**
     * Nombre de clase del controlador
     * 
     * @var string 
     */
    private $controller;
    
    /**
     * Nombre de la función del controlador
     * 
     * @var string 
     */
    private $function;
    
    // Métodos de la clase Service
    
    /**
     * Permite definir nombre del método HTTP del servicio
     * 
     * @param string $httpMethod Nombre del método HTTP
     * @return Service Instancia de clase como interfaz fluida
     */
    public function setHttpMethod(string $httpMethod): Service {
        $this->httpMethod = $httpMethod; return $this;
    }
    
    /**
     * Retorna el nombre del método HTTP del servicio
     * 
     * @return string Nombre del método HTTP
     */
    public function getHttpMethod(): string {
        return $this->httpMethod;
    }
    
    /**
     * Permite definir el enrutador del servicio
     * 
     * @param string $route Enrutador del servicio
     * @return Service Instancia de clase como interfaz fluida
     */
    public function setRoute(string $route): Service {
        $this->route = $route; return $this;
    }
    
    /**
     * Retorna el enrutador del servicio
     * 
     * @return string Enrutador del servicio
     */
    public function getRoute(): string {
        return $this->route;
    }
    
    /**
     * Pemite definir el nombre de clase del controlador
     * 
     * @param string $controller Nombre de clase del controlador
     * @return Service Instancia de clase como interfaz fluida
     */
    public function setController(string $controller): Service {
        $this->controller = $controller; return $this;
    }
    
    /**
     * Retorna el nombre de clase del controlador
     * 
     * @return string Nombre de clase del controlador
     */
    public function getController(): string {
        return $this->controller;
    }
    
    /**
     * Permite definir el nombre de la función ha ejecutar en el servicio
     * 
     * @param string $function Nombre de la función
     * @return Service Instancia de clase como interfaz fluida
     */
    public function setFunction(string $function): Service {
        $this->function = $function; return $this;
    }
    
    /**
     * Retorna el nombre de la función ha ejecutar en el servicio
     * 
     * @return string Nombre de la función
     */
    public function getFunction(): string {
        return $this->function;
    }
    
    /**
     * Retorna la estructura del proceso que se ejecutará en el servicio
     * 
     * @return string Estructura del proceso
     */
    public function getProcess(): string {
        return "{$this->controller}@{$this->function}"; // Proceso
    }
}
## Koldown HttpRoute

Librería que nos permite configurar las rutas de acceso (Endpoints) de nuestros API Services creados en `Laravel` de una manera sencilla y rápida.

## Instalación

    composer require koldown/httproute

## Modo de uso

Primero debemos establecer en el `Controller` las funciones ha consumir en la solicitud del API Services, agregandole en la sección de documentación lo siguiente:

    class PhotosController extends Controller {
        
        /**
         *
         * #Http(POST)
         * #Route(photos)
         */
        public function store() {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * #Http(GET)
         * #Route(photos)
         */
        public function index() {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * #Http(GET)
         * #Route(photos\{id})
         */
        public function record(Request $request) {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * #Http(PUT)
         * #Route(photos\{id})
         */
        public function update() {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * #Http(DELETE)
         * #Route(photos\{id})
         */
        public function destroy() {
            // Definir los procesos a realizar en la solicitud 
        }
    }

Una vez realizado vamos a nuestro archivo donde se configuran las rutas de API de nuestro proyecto `Laravel` y agregamos el siguiento código

    \Koldown\HttpRoute\RouteBuilder::getInstance()->readerController(PhotosController::class);

La función `readerController` de la clase `\Koldown\HttpRoute\RouteBuilder` recibe por parámetro la clase `Controller`, la cual recorre sus métodos
públicos y si encuentra en la sección de la documentación de cada uno de estos las anotaciones de la librería, generará de manera automática las rutas
de API Services del proyecto.

## Anotaciones

`#Http`
Establece el método HTTP para acceso al API Service que consumirá la función del controlador. Valores posibles POST, GET, PUT, DELETE.

`#Route`
Establece el patrón URL para acceso al API Service que consumirá la función del controlador.
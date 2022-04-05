<?php

/* 
 *  Importante: Deben enviar el link a la resolución en su repositorio en GitHub del ejercicio.
 *  
 *  La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus
 *  viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de 
 *  pasajeros y los pasajeros del viaje.
 *  
 *  Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los 
 *  atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la 
 *  información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves 
 *  “nombre”, “apellido” y “numero de documento”.
 *  
 *  Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que 
 *  permita cargar la información del viaje, modificar y ver sus datos.
 *  
 */

    class Viaje{
        
        private $codigoViaje;
        private $destinoViaje;
        private $cantPasajeros;
        private array $listaPasajeros;
        private static $maxCapacidad=4;

//constructor
        public function __construct($codigo, $destino){
            /*
             * funcion constructor
             * recibe por parametros el codigo del viaje y el destino
             * tanto los pasajeros como la cantidad seran modificados luego
             */
            $this->codigoViaje = $codigo;
            $this->destinoViaje = $destino;
            $this->cantPasajeros = 0;
            $this->listaPasajeros = [];
        }

//set       
        public function setCodigoViaje($codigo){
            /*
             * setea el codigo pasado por parametro
             */
            $this->codigoViaje = $codigo;
        }
        public function setDestinoViaje($destino){
            /*
             * setea el destino pasado por parametro
             */
            $this->destinoViaje = $destino;
        }
        public function setCantPasajeros($cant){
            /*
             * setea la cantidad de pasajeros
             * esta sera utilizada de manera dinamica cuando se agregue un pasajero nuevo
             */
            $this->cantPasajeros = $cant;
        }
        public function setListaPasajeros($lista){
            /*
             * setea la lista de pasajeros completa
             */
            $this->listaPasajeros = $lista;
        }

//get
        public function getCodigoViaje(){
            /*
             * retorna el codigo del viaje
             */
            $codigo=$this->codigoViaje;
            return $codigo;
        }
        public function getDestinoViaje(){
            /*
             * retorna el destino del viaje
             */
            $destino=$this->destinoViaje;
            return $destino;
        }
        public function getCantPasajeros(){
            /*
             * retorna la cantidad de pasajeros
             */
            $cant=$this->cantPasajeros;
            return $cant;
        }
        public function getListaPasajeros(){
            /*
             * retorna la lista completa de pasajeros
             */
            $lista=$this->listaPasajeros;
            return $lista;
        }

//tostring
        public function __toString(){
            /*
             * permite realizar una salida por pantalla del objeto
             * se tomo la decicion de realizar una salida como si fuera aun archivo csv
             * retorna una cadena
             */
            $cadena=$this->csvViaje()."\n".$this->csvLista();
            return $cadena;
        }

//others tostring
        private function csvViaje(){
            /*
             * funcion privada para generar el to string asi como el csv de los datos del viaje
             * retorna un string
             */
            $viaje = "";
            $viaje = $viaje . $this->getCodigoViaje().";";
            $viaje = $viaje . $this->getDestinoViaje().";";
            $viaje = $viaje . $this->getCantPasajeros();
            return $viaje;
        }
        private function csvLista(){
            /*
             * funcion privada para generar el to string asi como el csv de los datos de los pasajeros
             * retorna un string
             */
            $cadena="";
            $lista=$this->getListaPasajeros();
            foreach ($lista as $posicion => $pasajero){
                $cadena = $cadena.$posicion.";";
                $cadena = $cadena.$pasajero["apellido"].";";
                $cadena = $cadena.$pasajero["nombre"].";";
                $cadena = $cadena.$pasajero["dni"]."\n";
            }
            return $cadena;
        }

//mostrar
        public function mostrarViaje(){
            /*
             * funcion para mostrar los datos del viaje
             */
            $codigo=$this->getCodigoViaje();
            echo "Codigo de Viaje..............: ".$codigo."\n";
            $destino=$this->getDestinoViaje();
            echo "Destino de Viaje.............: ".$destino."\n";
            $cant=$this->getCantPasajeros();
            echo "Cantidad de Pasajeros........: ".$cant."\n";
            $max=$this->getMax();
            echo "Capacidad Maxima de Pasajeros: ".$max."\n";
        }
        public function mostrarLista(){
            /*
             * funcion para mostrar la lista de pasajeros
             */
            $lista=$this->getListaPasajeros();
            foreach (array_keys($lista) as $posicion){
                echo "Ubicacion....................: ".$posicion."\n";
                $this->mostrarPasajero($posicion);
            }
        }
        public function mostrarPasajero($ubicacion){
            /*
             * funcion  para mostrar un pasajero en particular dada su ubicacion
             */
            $persona=$this->getPasajero($ubicacion);
            $apellido=$persona["apellido"];
            echo "Apellido.....................: ".$apellido."\n";
            $nombre=$persona["nombre"];
            echo "Nombre.......................: ".$nombre."\n";
            $dni=$persona["dni"];
            echo "DNI..........................: ".$dni."\n";
        }

//static access
        public function setMax($max){
            /*
             * funcion para poder setear el elemento privado y estatico que mantiene la capacidad maxima de pasajeros
             */
            self::$maxCapacidad=$max;
        }
        public function getMax(){
            /*
             * funcion para poder leer el elemento privado y estatico que mantiene la capacidad maxima de pasajeros
             * retorna el valor 
             */
            $max=self::$maxCapacidad;
            return $max;
        }
                
//lista pasajeros
        public function addPasajero($persona){
            /*
             * funcion que permite agregar un pasajero al final de la lista de pasajeros
             * tambien incrementa el valor de cantidad de pasajeros
             */
            $cant = $this->getCantPasajeros();
            $cant++;
            $this->setCantPasajeros($cant);
            $lista = $this->getListaPasajeros();
            $lista[$cant] = $persona;
            $this->setListaPasajeros($lista);
        }

        public function delPasajero($ubicacion){
            /*
             * funcion que permite eliminar un pasajero de la lista de pasajeros dada su ubicacion
             * tambien reindexa la lista para que cada pasajero quede en su ubicacion
             * asi como tambien descuenta del valor de cantidad de pasajeros
             */
            $lista=$this->getListaPasajeros();
            unset($lista[$ubicacion]);
            $lista=array_values($lista);
            array_unshift($lista,null);
            unset($lista[0]);
            $this->setListaPasajeros($lista);
            $cant=$this->getCantPasajeros();
            $cant=$cant-1;
            $this->setCantPasajeros($cant);
        }
        
        public function getPasajero($ubicacion){
            /*
             * funcion permite retormar un pasajero dada su ubicacion
             */
            $lista=$this->getListaPasajeros();
            $persona=$lista[$ubicacion];
            return $persona;
        }
        
        public function setPasajero($ubicacion,$persona){
            /*
             * funcion permite setear un pasajero dada su ubicacion
             */
            $lista=$this->getListaPasajeros();
            $lista[$ubicacion]=$persona;
            $this->setListaPasajeros($lista);
        }
        
    }

?>